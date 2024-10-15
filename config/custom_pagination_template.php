<?php

return [
    // 'first' => '<a href="?page=1" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">{{text}}</a>',
    // 'prevActive' => '<a href="{{url}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">{{text}}</a>',
    // 'prevDisabled' => '<span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-300 bg-gray-100 border border-e-0 border-gray-300 rounded-s-lg cursor-not-allowed">{{text}}</span>',
    // 'number' => '<a href="{{url}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{text}}</a>',
    // 'current' => '<span class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-primary-50 hover:bg-primary-100 hover:text-primary-700 cursor-not-allowed">{{text}}</span>',
    // 'nextActive' => '<a href="{{url}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">{{text}}</a>',
    // 'nextDisabled' => '<span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-300 bg-gray-100 border border-e-0 border-gray-300 rounded-e-lg cursor-not-allowed">{{text}}</span>',
    // 'last' => '<a href="{{url}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">{{text}}</a>',

    'nextActive' => '<li class="next"><a rel="next" href="{{url}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">{{text}}</a></li>',
    'nextDisabled' => '<li class="next disabled flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700"><a href="" onclick="return false;">{{text}}</a></li>',
    'prevActive' => '<li class="prev"><a rel="prev" href="{{url}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">{{text}}</a></li>',
    'prevDisabled' => '<li class="prev disabled flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700"><a href="" onclick="return false;">{{text}}</a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="first"><a href="?page=1" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">{{text}}</a></li>',
    'last' => '<li class="last"><a href="{{url}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">{{text}}</a></li>',
    'number' => '<li><a href="{{url}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{text}}</a></li>',
    'current' => '<li class="active"><a href="" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-primary-50 hover:bg-primary-100 hover:text-primary-700 cursor-not-allowed">{{text}}</a></li>',
    'ellipsis' => '<li class="ellipsis">&hellip;</li>',
    'sort' => '<a href="{{url}}">{{text}}</a>',
    'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
    'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
    'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',

];