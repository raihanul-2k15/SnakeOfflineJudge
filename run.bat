cd data
cd judge
start "" /b cmd /c "under_judgement.exe < main_input.txt > test_output.txt"
timeout /nobreak /t 10
tasklist | find "under_judgement.exe" > tle.txt && taskkill /f /im under_judgement.exe