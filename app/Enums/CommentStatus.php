<?php

namespace App\Enums;
enum CommentStatus: string{
    case Draft = 'draft';
    case Accept = 'Accept';
    case Reject = 'reject';
}
