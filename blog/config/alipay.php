<?php
return [

	
		//应用ID,您的APPID。
		'app_id' => "2016092500596839",

		//商户私钥
		'merchant_private_key' => "MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCKik8UtAhM4FIDErdNF6b6yOgxvbk8yLw2V7goDMr1cnwLDTk4OYA4i3d68DMIMyopmbn2AP6Gpucq9DOZTTIPXb8jW8C1K5Xbz42NPyaYwpn2U72psZH22rY4Ab67zN4AtzZIk9KCojQkpfxodpa6AxPQFit4J443k7KDlu75Zn8fHo+X9kAZiAAAKQ6hUOC4n5MlV6C0Bylqs0bmLeleB8dzWo31ffHqVZ3exYQWo8qaKsRWZlH305hGcQv9YnHnbaKvukmHkX2mhTSaO0s/dSjIbTgKs9TQQQWHjupXaSzvefu5DjeHICVsBQXV42tccYkY/hww9rkBYqhxiBIzAgMBAAECggEAe2IogfjAt67Ee6Ysh8U72ngZi0s78S2ZqhA/m7OhAi3+2Vzii/dyAWn8dAn+eRwQPdKCMty50jRNBw1L8wk0P0kvlI7/tpplsclMePI4Lq6Jrj7wWHQj2iT5SjILq3gOc7a36rV0MxHAvK7zeBm9rVZWS+mitzULTOYGg3llxckztnOUqEX4Kr5hiq+2+wpU2+sxkQAQCm6Grl/kRW11cyphlgCzTSiHPVKFXwBKGG5J9bT0fdC21G/rkWsoNSPtkR/e4Tc86K+7E7YtLgUidWUi/5CjNcIq4cbBlVHqwjDCH3z34Q2Zvw3uHIIR60kXwmM9Gn0ZVY9sgPy3YkYQOQKBgQDmfg8UUvqOsGZVDCNv3Fuz12DsA98fHF6FUquVc+Q+Bb2Ie9C1vtN7qeku1A196Uqjev8YweGuMFMBLQj/N8wcjiVqWIU8MYCd0GcqvTT9Bwt9V1gsiZSUL1CPHJE4hzBVN73CBjRbL4odwecj0HrwFGTaRJy9ozwC4wcA7Gu6vQKBgQCZ3zWZoVm10eThYjhXgY07IiYtNyyqwfNrCCwIda3qzKOl0EKdLHXWIrIvsScrm9yTDI+dMwdZheJEbx6hFIASNh8nUEx39y4OQ9v9WEIAeJmQQ0NJtthTzx8bRXP8WWklDSGM0YHgrDP1FVUqxDSIehgh+j6ASKVYwoopjY1HrwKBgQC+DBC47FZl0rL9yv1pHWOLXLowwFx3lXemLG0H1L/MGAWYBKcpRAeyPn3jO7tIJ1SAiUjPDAXeD0BRhuWVMlec7+OP1R8+a36mIRD/n3SScP2bQqqURnh42q5s4dwnpOhIS6at1VnUGdWjBZ9k22CSle42Pj6S6oXvx2ud6lJFbQKBgGMlQ/A92wQgvo3LL+qSe2IC2v5/crSETEhG97hruyhzu254BrQnlbXonU/FoiujPjkx+sebvbydW/Ikd2PrRap2XRSD1QHnrzFZ4EIZwE11Z91gudahjjpSVwTHd7i+E9Xf5CJMTJdr3f6pRDtOOVtG8I3UJLmcFY5fq46iusnZAoGBAJ7gJFHR2aGG7z6KhIIAfbXQsZV0phW2IVgyLnq889cV0WYs2YuuQKtm5xCRbSM1XCpDCRFyFJg9GxMmvhDzcUFaDTpHjt6EAxOa2pcaXd8LnvzZg5HzzSIylXQByZg7MUwD+UXymVOvxalhcgdpnIv+8Uqh7l9N9CPWWUpTDw/b",
		
		//异步通知地址
		'notify_url' => "http://wang.com/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://wang.com/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvl9x3YyX1pd/XrI/d8AKry2lQ5nMZUEOKVPT8TaftrJBfchZTeeBUX9JUDbDifRNlzmN9LvT2cVDI4r8/b7SSAspnxfsNIhwgWxDJxSHR4yK73cKk5rFAIibhiJwBsDiyKM+FDNZEyZoxH7IGu+K1jie2uulIZsyaSd0i6+7QCI9vEKVWibQDZ6Exs9CWxTnuQRSmXqQ+DUskuv/n/Q2u1A5BaGD/COe4gk40CH+vgzQ0eq/YfNXwts0Y1qU8BkhbCWA0TtbooWlxm3eS0L+nRtJG//jNNzfuhT8PiskNVKEa8xhsjWL5AsV7jin+5WUZY6t1geeAyVurGsr9HT9JQIDAQAB",


];