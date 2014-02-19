<?php

use BmCalendar\DayProviderInterface; 
use BmCalendar\Day; 
use BmCalendar\Month;

class MyDayProvider implements DayProviderInterface { 

  public $database;

  public function createDay(Month $month, $dayNo)
  {
    $day = new Day($month, $dayNo);

    $avaliable = $this->database->checkAvailability(
      $month->getYear()->value(),
      $month->value(),
      $dayNo
    );

    if (!$available) {
      $day->addState(new BookedState());

      return $day;
    }

    $day->addState(new AvailableState());
    $day->setAction('http://url-to-booking-form');

    return $day;
  }
}
