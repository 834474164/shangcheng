<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016091700531899",

		//商户私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEAwfO/gEqQVFgulDRMnhhgxUYxyFJ4JV6ivRdXSwcaJrUjBQ+bEaqWS3oB5Y3YhmyOo3tAwZd9zjjgg0MoxAvTxZCAfoAPWwpK0UUjUHuV25LyrClGv9k+qJztfd2biv7Bb+hYV3Km3R5QjqHGnfSTjlOPg83qj74TpqNROYFSyvuBdM0egqm9bMZV9VIbGTwiG1l3A/QG9Mp/18pfbNr6fYBJp0v83L6jeXo8rN3wbV9R9rJZOmfJ+h9TWDgvBZsit8wMWK1spQX5HbfMJI7gzUon7ZYXP6jfF2W6g/xvbYXp8SWZHiIw7MBDTu30UAJ4qWkDTIBlLuAXbpkZeDqtKQIDAQABAoIBACO/OCl+FLHm+tbH+OMenR9e+6fvQ0On+JifZ7BlY7WEpyq0oKEV7tOEbjsP9Lt54KRTADFuKXrL0t1+kFHp2CNOqdAm7C2cbQO7GXIpBQrOP7npdafAc6MCIWeUY6mvoJlumnGrqQOSJcjUGlZckKGn1wi0+Cl8IAUTjtHpewf8FkhIRP5CYZ8fUfW4GPS2EnMb8SBX9gaMKkiohQMOo9ZaytV3dyiC2cAxAL+UEzun2L6DXfFgtgGiBlW9oNf0kPrMWGY3dUneOHFLXRUqYwT2W6xOeS6Q/QY0ywTdRAzhQx9cO7ovlvcaMCTR2+WJEOD1NkvIRE3hA3x+8BOt0bECgYEA+cnEjjhDwQyoYs9CIDlhwww6pEiLZHbZE/8S74JtaxZK0UqnxxVR8Ur6HEgJWGCpVExgrYjeOu5aWKWuf28jfQKywl5FX8D2QkyLX1KuL6FQStagMIDV2trR2GWLH4v3dcRaWEi+7vCdJJwbv3hZZOCNGWIRohZ8j3e9cFiWhTUCgYEAxsaCl3w8/+IJSLp7P6xvraRRBrxRdkrG89RrGqQM+3MFjAY07elKx8b5Vc+mplcJMHWQtmxIhy0ALJ0iA7xqswJoKwtivb8L1D6PEwKtVedihsDTaJ7GkDJIBp81zTfZ3H+3wMr5j5/VvHGhABqXXyY3QPAJfwny9orzjhwPyqUCgYEAtChWX80s8PvUJxAdPWilniwfz4WTI+6kOsvqOFz11hrJ85HI2MoDw+iz49oBA4EUH/zGbeMdhZuMBgvZg4gBLJTZoV6k4p8l/kN+8k2L3EaYxqFuAA2sMKFKYK08XpBw9rub/bjaHTPl4xXE3aBLuXpLylb1KNbXGBLgyzrZtVECgYEAgsvU2sFRkj62RTkQKJHa2rOo7Xm1UNVbnM5Fu73/HOZO3Bipc3NzVYnEP4bn7cSPs2do1eDiyK//0VuEKlktDKWkzc4sJxczPXH8y1GTpVcgKfNwKQNxPSkY4+KXkHYT0VfpHd9x3+QYzGsoudzFhkKrUPuiBAoT6c78/KHSclECgYEAhqCWXT+DkmtE5SG/G/js/NCr2gRugZDAWqy0kgVxfMogWB/e+bsRCUsAFOEJmBo+Ju41s9mzcu21foinhonM392XEOmCGPhEUQuDy5tZOh68FfbFyqDEBF8SGpQYiAs8IrEyi0yDNVu8LC33HRC/Hbl84ipQCXNPUJ07c1pfA1Y=",
		
		//异步通知地址
		'notify_url' => "http://lyxar.sunchangkuan.com/home/money/return",
		
		//同步跳转
		'return_url' => "http://lyxar.sunchangkuan.com/home/money/notify",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArjdo3ddtbNVTZ8z88r78EivrsFFvckvu7UeKptNUYOKlLy17YT6jKlr7v4tL5RF1E2YVSss5gAkYfZL1TwY1KES5z8eff6x8fw33/PTzCb6lG9MxvwPRo7/uTqpLpGC0fd5NLc71XBdakTc/pIiFYwYHTwj1lI2mtwKcOybhNOw9JDjqncXxOXui9BekV0vzUtLVVKj7tDG6m/TNq6bqwTyR4QNy3ePz3k/U2vuB5DcUR0q3HuIH7BuaWIzxRpjuEdhIDWbylDQGn2jV3lUy7Fj1lgH0uHth3MkfQLBGREs95RApdwMNP+AzU79oz1giOXRVd6ZdF0wxDz18t5/8YwIDAQAB",
);