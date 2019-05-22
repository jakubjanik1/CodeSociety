<?php

namespace Services;

use Spatie\Analytics\Analytics as _Analytics;
use Core\App;
use Carbon\Carbon;

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
            __DIR__ . '\..\..\config\analytics.p12'
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
}