<?php

interface ISubject {
    public function addObserver(IObserver $Iobserver);
    public function removeObserver(IObserver $Iobserver);
    public function notifyObservers();
}