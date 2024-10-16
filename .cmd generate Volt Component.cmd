@echo off
echo ^> running command make:volt ^<path^>
echo ^> use double slashes on query to set dir
echo ^> example: dir//dir//filename
echo ^> note that file will be generated in resources/views/livewire/^<path^>
CALL:GENERATECOMPONENT
EXIT /B %ERRORLEVEL%

:GENERATECOMPONENT
set /p query="path: "
IF DEFINED query (
php artisan make:volt %query%
) ELSE (
goto :RETRY
)
echo command done
goto :PROMPT

:PROMPT
SET /P REPEAT="Make more? (Y/[N])"
IF /I "%REPEAT%" == "Y" (GOTO :GENERATECOMPONENT)
IF /I "%REPEAT%" == "y" (GOTO :GENERATECOMPONENT)
IF /I "%REPEAT%" NEQ "Y" IF /I "%REPEAT%" NEQ "y" (GOTO :CLOSEWINDOW)

:RETRY
echo query cannot be empty
goto :GENERATECOMPONENT

:CLOSEWINDOW
echo .
echo .
echo ^> command executed
pause
EXIT /B 0