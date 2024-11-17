<?php

enum RequestStatus : int {
    case Processing = 0;
    case Accepted = 1;
    case Refused = 2;
}