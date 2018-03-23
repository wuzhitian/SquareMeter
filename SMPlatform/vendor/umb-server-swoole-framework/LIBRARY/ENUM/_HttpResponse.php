<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _HttpResponse.phpCreate: 2018/3/22
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * http_response枚举类型
 * Class _HttpResponse
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _HttpResponse
{
    //API
    const API = 'API';

    //parse
    const php = 'php';

    //html
    const css  = 'css';
    const js   = 'js';
    const html = 'html';
    const map  = 'map';
    const json = 'json';

    //picture
    const ico   = 'ico';
    const bmp   = 'bmp';
    const png   = 'png';
    const jpg   = 'jpg';
    const gif   = 'gif';
    const eot   = 'eot';
    const svg   = 'svg';
    const ttf   = 'ttf';
    const woff  = 'woff';
    const woff2 = 'woff2';

    //video
    const mp4 = 'mp4';
    const ogv = 'ogv';
    const mpg = 'mpg';
    const avi = 'avi';

    //audio
    const mp3 = 'mp3';

    //download
    const zip = 'zip';
    const rar = 'rar';
    const tar = 'tar';
    const gz  = 'gz';
    const tgz = 'tgz';

    //document
    const doc  = 'doc';
    const docx = 'docx';
    const ppt  = 'ppt';
    const pptx = 'pptx';
    const xls  = 'xls';
    const xlsx = 'xlsx';
    const pdf  = 'pdf';
}