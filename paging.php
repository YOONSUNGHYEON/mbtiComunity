<?php

function paging($rowCount, $currentPage = null)
{
    $blockCount = 10;
    $blockPage = 10;


    if ($currentPage == null)
        $currentPage = 1;

    $totalPage = floor(($rowCount - 1) / $blockPage) + 1;

    if ($totalPage < $currentPage)
        $currentPage = $totalPage;

    if ($currentPage < 1)
        $currentPage = 1;

    $data['startCount'] = ($currentPage - 1) * $blockCount;

    $data['startPage'] = floor(($currentPage - 1) / $blockPage) * $blockPage + 1;
    $data['endPage'] = $data['startPage'] + $blockCount - 1;

    if ($data['endPage'] > $totalPage)
        $data['endPage'] = $totalPage;

    $data['limitArray'] = Array(
        $data['startCount'],
        $blockCount
    );

    $data['currentPage'] = $currentPage;
    $data['blockPage'] = $blockPage;
    $data['totalPage'] = $totalPage;
    $data['blockCount'] = $blockCount;
    return $data;
}
