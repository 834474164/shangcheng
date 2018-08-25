<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016091700531899",

		//商户私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEA045zrEjm5BM/PIZQtq9IjXynMVzk5gE7PW63yK6AXSBJapR1zbu4tscm6FmF4ZRQFJbn4fwmNWBBaymaYQ+XHDaCgiKAu7TcmBcb8fli/LDkIGq5AIZeVnIlVcTd/MtqqigcByu9AHYrtcyE/zESLVTE2wO/U3zSedGdSd7iJ1A+5ceCDhRZoe13XvsjmpxFwPBG8dfIyevwzGcvGX9IcqqKovagTZ/mh4pQw3DD4GHSehFgA+ducXX7m2Uidh9H7exT9/w6gI95NavvmSrlUQYI/HU5XXiaGFLQWkOFHxgtvjQ3kbRj0edtRxQitCfJjHUGXRS03dJk42L+mTpWWwIDAQABAoIBAECBjBW5OOXMVJjQ36WEdtvlaVls2MKlF3oY22MOikdbA+fCktUDa0QYH23zdhYdUfmlNdk7OC9IRUo2qkL0LQBGQq8JdDVH5YdebH/wqdUg3r5frD9TuUokjevEFmfxYnm1ty4ckQml/pf1X4wsWz2FPm0FjH4ZblgEqTAQDOctS6qH0ApUKiSvwAepsHFAflEkTe06ZHoosvwEwvE2YzmqS1dL2C0Jq9xYefbPYbbStQq9zP9vRQcmFU4sbMDkW/kqubH6+q06MfRDJMzniti58BNo4cV8379fNTdAyqbJhvRimLVfF5YBKTdZbf2oZ4p9Jmt4rKP2TgSAzhotq2kCgYEA8b/c2KA1bVOT2AcekP7e+UQ+IQk5fRMl0iUHtrm6q7qB5VIbidfXshe/xddVZeSOf95lPYwROsTI8eloMtBl9oFkowOgLBLRAsSKemo5EZbd/iFU95mbD8pKqhkhxpaLzAsIoQs9dz/TicmtgcRVIBnw++d++epq/ks4dPC0Ue8CgYEA4Ab1m5q7XebxI/TMcUMqcLVJVBkQpkemZeylCKnZYsZpH3XJh+BbmGzqzzAXATRhUgAPf84j6CLa3pINzxqIOnxXsMqwoByJk7V9BDDSzWHhHG2UpDmQRlcDSVz4Q4qbzyuIyTfl3fB4uGZ5VATkSYIIon2xZn5GT3xriEzw/lUCgYEA34BQf35upqq0bu72FXttTesHvac3nSkMuGI/5XGE4avG1+q3RxNkeWR3ikNw0okiLZnA48wRSdIRLYZrLT96ZRJvpj594QFsdzCaDl8Sb+6ZQpAya895inmt2eDuVxlsGbLBwZIQu6Uov6TTYrvPL6SMJXh67jcJwBxvD75SF8UCgYEA0TuOvrLoVg5wn61uGEar57JZd1Mlqrd2oPFBPfMslkVLP1fKTr5rrdPkBngatERQtL5bu3kzLgcHtiJhBVH5c+5YFEVqa0/b6nnx9i0HZU0Ka3uo/SzKI/f2mNldAe/+D6LQUWaEqSGEDm2e2arr7/+jwudz/Y7oaiqBYD7EQjUCgYEAuX/S+ottAQXuyfLtY1iaWIXBE6qwBQWr+4uH9n/E0n9jAb4BzBC0N5/h4dDCMvP9MeTGCxhJPoPziwtyCw5yTJXfGqdm5BzdqxlKiZKMkqOlEj4Jfr7uFL3urqjpWTp3yTxRYcMnU/nwdT4Usg6r7z+OwNrjdVEz/nPRBjaFm68=",
		
		//异步通知地址
		'notify_url' => "http://local.shangcheng.com/home/goods/",
		
		//同步跳转
		'return_url' => "http://local.shangcheng.com/home/goods/together_callback",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArjdo3ddtbNVTZ8z88r78EivrsFFvckvu7UeKptNUYOKlLy17YT6jKlr7v4tL5RF1E2YVSss5gAkYfZL1TwY1KES5z8eff6x8fw33/PTzCb6lG9MxvwPRo7/uTqpLpGC0fd5NLc71XBdakTc/pIiFYwYHTwj1lI2mtwKcOybhNOw9JDjqncXxOXui9BekV0vzUtLVVKj7tDG6m/TNq6bqwTyR4QNy3ePz3k/U2vuB5DcUR0q3HuIH7BuaWIzxRpjuEdhIDWbylDQGn2jV3lUy7Fj1lgH0uHth3MkfQLBGREs95RApdwMNP+AzU79oz1giOXRVd6ZdF0wxDz18t5/8YwIDAQAB",
);