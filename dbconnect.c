#include <stdio.h>
#include <string.h>
#include "/usr/local/Cellar/mysql-client/8.0.18/include/mysql/mysql.h"
#include <stdlib.h>
#include "/usr/local/Cellar/mysql-client/8.0.18/include/mysql/mysql/udf_registration_types.h"

#pragma comment(lib, "libmysql.lib")

int  main()
{
	MYSQL mysql;
	mysql_init(&mysql);

	if(!mysql_real_connect(&mysql,NULL,"root","0000",NULL,3306,(char*)NULL,0))
	{
		printf("error\n");
		exit(1);
	}

	printf("connection success\n");

	mysql_close(&mysql);

	return 0;

}
