<?php

namespace Services;

use Spatie\Analytics\Analytics as _Analytics;
use Core\App;
use Carbon\Carbon;
use Bbsnly\ChartJs\{LineChart, DoughnutChart};

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
                    'fontFamily' => 'Dosis, sans-serif',
                    'fontSize' => 14
                ]
            ], 
            'title' => [
                'text' => 'Last week visits', 
                'display' => true,
                'fontSize' => 19,
                'fontFamily' => 'Dosis, sans-serif',
                'fontStyle' => 'normal',
                'padding' => 16
            ],
            'tooltips' => [
                'backgroundColor' => '#6d6d6d',
                'bodyFontFamily' => 'Dosis, sans-serif'
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
                    'fontFamily' => 'Dosis, sans-serif',
                    'fontSize' => 14
                ]
            ], 
            'title' => [
                'text' => 'Top browsers', 
                'display' => true,
                'fontSize' => 19,
                'fontFamily' => 'Dosis, sans-serif',
                'fontStyle' => 'normal',
                'padding' => 16
            ],
            'tooltips' => [
                'backgroundColor' => '#6d6d6d',
                'bodyFontFamily' => 'Dosis, sans-serif'
            ]
        ]);

        return $chart->toHtml('card__chart--browsers');
    }
}