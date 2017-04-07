<?php
namespace test;

use Vestin\Hook\Target;

class StartTarget implements Target{

    public function exec()
    {
        return 'im starting';
    }

}