<?php
require_once __DIR__ . '/lib/WxPay.Api.php'; class NativePay { public function GetPrePayUrl($sp427bbc) { $sp969f86 = new WxPayBizPayUrl(); $sp969f86->SetProduct_id($sp427bbc); $spdd7a68 = WxpayApi::bizpayurl($sp969f86); $spd2457c = 'weixin://wxpay/bizpayurl?' . $this->ToUrlParams($spdd7a68); return $spd2457c; } private function ToUrlParams($sp795036) { $sp37ee7b = ''; foreach ($sp795036 as $sp17f3a7 => $sp75c248) { $sp37ee7b .= $sp17f3a7 . '=' . $sp75c248 . '&'; } $sp37ee7b = trim($sp37ee7b, '&'); return $sp37ee7b; } public function unifiedOrder($spfaaf1d) { return WxPayApi::unifiedOrder($spfaaf1d); } }