rem カレントディレクトリにCD
cd /d %~dp0
rem 現在のディレクトリ名を取得
for %%I in (.) do set DIRNAME=%%~nI%%~xI
rem SCSS監視開始
start "%DIRNAME%" compass watch --time