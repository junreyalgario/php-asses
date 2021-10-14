<?php

namespace SMS\Controllers;

class ErrorCont {

    public function error404()
    {
        view('404_view', []);
    }
}