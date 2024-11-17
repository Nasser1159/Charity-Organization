<?php

enum OrderStatus : int {
    case Received = 0;
    case Placed = 1;
    case InProgress = 2;
}
