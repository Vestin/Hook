<?php
namespace test;

use Vestin\Hook\Target;

class DoneTarget implements Target{

    public function exec()
    {
        return 'im done';
    }

}