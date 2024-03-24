<?php

function tagName($tag)
{
    if ($tag == 'reti') {
        return 'Reti';
    } else if ($tag == 'cybersecurity') {
        return 'Cybersecurity';
    } else {
        return '';
    }
}

function tagColor($tag)
{
    if ($tag == 'reti') {
        return 'red';
    } else if ($tag == 'cybersecurity') {
        return 'brown';
    } else {
        return '';
    }
}
