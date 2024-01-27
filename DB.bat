@echo off > %temp%\# & setLocal EnableDelayedExpansion
echo -: MYSOFTHEAVEN (BD) LTD. DATABASE BACKUP SCRIPT :-
echo DATABASE BACKUP START. DO NOT EXIT THIS WINDOW...
Set TODAYSDATE= "%date:~7,2%-%date:~4,2%-%date:~10,4%_backup.txt"
CD D:\xampp\mysql\bin
mysqldump --lock-all-tables --opt --user=root --password=mshssssss  sssss > %TODAYSDATE% 
@echo on
pause