<?php

class GetDate
{
    public static function getDaysLeft()
    {
        $daysleftinMonth = date('t') - date('j');

        $daysLeft = ($daysleftinMonth == 0) ? 'последний' : $daysleftinMonth;
        $pre = 'осталось';

        if ($daysLeft == 1 || $daysLeft == 0 || $daysLeft == 21 || $daysLeft == 31) {
            $ofDays = 'день';
            $pre = 'остался';
        } elseif ($daysLeft > 1 && $daysLeft < 5 || $daysLeft > 21 && $daysLeft < 25) {
            $ofDays = 'дня';
        } else {
            $ofDays = 'дней';
        }
        return $pre . ' ' . $daysLeft . ' ' . $ofDays;
    }
    public static function getCurentMonth()
    {
        $monthsNames = [
            'январе',
            'феврале',
            'марте',
            'апреле',
            'мае',
            'июне',
            'июле',
            'августе',
            'сентябре',
            'октябре',
            'ноябре',
            'декабре'
        ];
        $monthNumber = date('n');
        return $monthsNames[$monthNumber - 1];
    }
}