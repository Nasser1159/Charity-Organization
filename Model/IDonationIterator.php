<?php

interface IDonationIterator {
    public function hasNext(): bool;
    public function next(): array;
}
