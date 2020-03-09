<?php
if(ini_get('allow_url_fopen') == '1')
{
	//fopen() 이나 file_get_contents() 사용
}
else
{
	//curl 이나 함수 직접 작성
}
