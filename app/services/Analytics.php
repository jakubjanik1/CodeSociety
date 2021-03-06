<?php

namespace Services;

use Spatie\Analytics\Analytics as _Analytics;
use Core\App;
use Carbon\Carbon;
use Bbsnly\ChartJs\{LineChart, DoughnutChart, BarChart};
use Khill\Lavacharts\Lavacharts;

class Analytics
{
    private $analytics;
    private $db;

    public function __construct()
    {
        $credentials = App::get('config')['analytics'];

        $this->analytics = _Analytics::create(
            $credentials['site_id'],
            $credentials['client_id'],
            $credentials['service_email'],
            __DIR__ . '/../../config/analytics.p12'
        );

        $this->db = App::get('database');
    }

    public function getVisitsFromToday()
    {
        $latestVisits = $this->analytics->getVisitorsAndPageViewsForPeriod(Carbon::now()->startOfDay(), Carbon::now());

        return array_slice($latestVisits, -1)[0]['visitors'];
    }

    public function getNewAccountsFromToday()
    {
        $accountDates = $this->db->table('account')->value('created')->get();

        return $this->getCountOfTodayDates($accountDates);
    }

    public function getNewArticlesFromToday()
    {
        $articleDates = $this->db->table('article')->value('date')->get();

        return $this->getCountOfTodayDates($articleDates);
    }

    public function getNewCommentsFromToday()
    {
        $commentDates = $this->db->table('comment')->value('written')->get();
        
        return $this->getCountOfTodayDates($commentDates);
    }

    private function getCountOfTodayDates($dates)
    {
        $dates = array_filter($dates, function($date) {
            return Carbon::parse($date)->greaterThanOrEqualTo(Carbon::now()->startOfDay());
        });

        return count($dates);
    }

    public function getVisitsChartFromLastWeek()
    {
        $latestVisits = $this->analytics->getVisitorsAndPageViewsForPeriod(Carbon::now()->subDays(6), Carbon::now());

        $labels = array_map(function($item) {
            return Carbon::parse($item['date'])->format('D');
        }, $latestVisits);

        $visits = array_map(function($item) {
            return $item['visitors'];
        }, $latestVisits);

        $pageViews = array_map(function($item) {
            return $item['pageViews'];
        }, $latestVisits);

        $chart = new LineChart();

        $chart->data([
            'labels' => $labels,
            'datasets' => [[
                'data' => $pageViews,
                'backgroundColor' => 'transparent',
                'borderColor' => '#3dd07d',
                'label' => 'Page Views'
            ], [
                'data' => $visits,
                'backgroundColor' => 'transparent',
                'borderColor' => '#ff7979',
                'label' => 'Visits'
            ]]
        ]);

        $chart->options([
            'responsive' => true, 
            'maintainAspectRatio' => false,
            'legend' => [
                'display' => true,
                'position' => 'bottom',
                'labels' => [
                    'padding' => 16,
                    'fontFamily' => 'Titillium Web, sans-serif',
                    'fontSize' => 14
                ]
            ], 
            'title' => [
                'text' => 'Last week visits', 
                'display' => true,
                'fontSize' => 19,
                'fontFamily' => 'Titillium Web, sans-serif',
                'fontStyle' => 'normal',
                'padding' => 16
            ],
            'tooltips' => [
                'backgroundColor' => '#6d6d6d',
                'bodyFontFamily' => 'Titillium Web, sans-serif'
            ]
        ]);

        return $chart->toHtml('card__chart--visits');
    }

    public function getBrowsersChart()
    {
        $browsers = $this->analytics->getTopBrowsers();

        $labels = array_map(function($item) {
            return $item['browser'];
        }, $browsers);
        
        $values = array_map(function($item) {
            return $item['sessions'];
        }, $browsers);

        $sum = array_sum($values);

        $values = array_map(function($value) use ($sum) {
            return round(($value / $sum) * 100, 1);
        }, $values);

        $chart = new DoughnutChart();

        $colors = ['#3dd07d', '#ff7979', '#7979ff', '#d9dc0e', '#da63b0', '#5a5357'];
        $chart->data([
            'labels' => $labels,
            'datasets' => [[
                'data' => $values,
                'backgroundColor' => $colors,
                'hoverBackgroundColor' =>  $colors,
                'borderColor' =>  '#fff',
                'hoverBorderColor' =>  '#fff'
            ]]
        ]);

        $chart->options([
            'responsive' => true, 
            'maintainAspectRatio' => false,
            'legend' => [
                'display' => true,
                'position' => 'bottom',
                'labels' => [
                    'padding' => 20,
                    'fontFamily' => 'Titillium Web, sans-serif',
                    'fontSize' => 14
                ]
            ], 
            'title' => [
                'text' => 'Top browsers', 
                'display' => true,
                'fontSize' => 19,
                'fontFamily' => 'Titillium Web, sans-serif',
                'fontStyle' => 'normal',
                'padding' => 16
            ],
            'tooltips' => [
                'backgroundColor' => '#6d6d6d',
                'bodyFontFamily' => 'Titillium Web, sans-serif'
            ]
        ]);

        return $chart->toHtml('card__chart--browsers');
    }

    public function getVisitsMap()
    {
        $countries = $this->analytics->performQuery(
            Carbon::now()->subYear(), 
            Carbon::now(), 
            'ga:sessions', ['dimensions' => 'ga:country']
        );

        $chart = new Lavacharts();

        $data = $chart->DataTable();

        $data->addStringColumn('Country')
            ->addNumberColumn('Visists')
            ->addRows($countries->rows);

        $chart->GeoChart('Visits', $data);
        return $chart;
    }

    public function getMostVisitedPagesFromLastWeek()
    {
        $mostVisitedPages = $this->analytics->getMostVisitedPagesForPeriod(Carbon::now()->subDays(6), Carbon::now());

        $pages = [];
        foreach ($mostVisitedPages as $item)
        {
            $pages[$item['url']] = (int)$item['pageViews'];
        }

        $labels = [];
        foreach ($pages as $page => $visits) 
        {
            $key = substr($page, 0, 19);
            if (strlen($page) > 19) $key .= '...';

            $labels[] = $key;
        }

        $chart = new BarChart();
        $chart->type = 'horizontalBar';

        $chart->data([
            'labels' => $labels,
            'datasets' => [[
                'data' => array_values($pages),
                'backgroundColor' => '#3dd07d',
                'hoverBackgroundColor' => '#3dd07d',
                'borderColor' => '#3dd07d',
                'hoverBorderColor' => '#3dd07d',
                'label' => 'Page Views'
            ]]
        ]);

        $chart->options([
            'responsive' => true, 
            'maintainAspectRatio' => false,
            'legend' => [
                'display' => true,
                'position' => 'bottom',
                'labels' => [
                    'padding' => 20,
                    'fontFamily' => 'Titillium Web, sans-serif',
                    'fontSize' => 14
                ]
            ], 
            'title' => [
                'text' => 'Last week most visited pages', 
                'display' => true,
                'fontSize' => 19,
                'fontFamily' => 'Titillium Web, sans-serif',
                'fontStyle' => 'normal',
                'padding' => 16
            ],
            'tooltips' => [
                'backgroundColor' => '#6d6d6d',
                'bodyFontFamily' => 'Titillium Web, sans-serif',
                'label' => 'sdadsa'
            ]
        ]);

        return $chart->toHtml('card__chart--pages');
    }
}