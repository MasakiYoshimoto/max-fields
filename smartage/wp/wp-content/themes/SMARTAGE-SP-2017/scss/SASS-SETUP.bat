rem �J�����g�f�B���N�g����CD
cd /d %~dp0
rem ���݂̃f�B���N�g�������擾
for %%I in (.) do set DIRNAME=%%~nI%%~xI
rem SCSS�Ď��J�n
start "%DIRNAME%" compass watch --time