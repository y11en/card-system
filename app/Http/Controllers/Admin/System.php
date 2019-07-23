<?php
namespace App\Http\Controllers\Admin; use App\Library\Helper; use App\Library\Response; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use Illuminate\Support\Facades\Mail; class System extends Controller { private function set(Request $spf066f3, $spfb8cbe) { foreach ($spfb8cbe as $sp34e4b5) { if ($spf066f3->has($sp34e4b5)) { \App\System::_set($sp34e4b5, $spf066f3->post($sp34e4b5)); } } } private function setMoney(Request $spf066f3, $spfb8cbe) { foreach ($spfb8cbe as $sp34e4b5) { if ($spf066f3->has($sp34e4b5)) { \App\System::_set($sp34e4b5, (int) round($spf066f3->post($sp34e4b5) * 100)); } } } private function setInt(Request $spf066f3, $spfb8cbe) { foreach ($spfb8cbe as $sp34e4b5) { if ($spf066f3->has($sp34e4b5)) { \App\System::_set($sp34e4b5, (int) $spf066f3->post($sp34e4b5)); } } } function setItem(Request $spf066f3) { $sp34e4b5 = $spf066f3->post('name'); $sp8b9401 = $spf066f3->post('value'); if (!$sp34e4b5 || !$sp8b9401) { return Response::forbidden(); } \App\System::_set($sp34e4b5, $sp8b9401); return Response::success(); } function info(Request $spf066f3) { $spe8d0d0 = array('app_name', 'app_title', 'app_url', 'app_url_api', 'keywords', 'description', 'shop_ann', 'shop_ann_pop', 'shop_qq', 'company', 'js_tj', 'js_kf'); $spbf0f91 = array('shop_inventory'); if ($spf066f3->isMethod('GET')) { $sp9d4382 = array(); foreach ($spe8d0d0 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = \App\System::_get($sp34e4b5); } foreach ($spbf0f91 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = (int) \App\System::_get($sp34e4b5); } return Response::success($sp9d4382); } $spd2457c = array('app_url' => Helper::format_url($_POST['app_url']), 'app_url_api' => Helper::format_url($_POST['app_url_api'])); $spf066f3->merge($spd2457c); $this->set($spf066f3, $spe8d0d0); $this->setInt($spf066f3, $spbf0f91); return Response::success(); } function theme(Request $spf066f3) { if ($spf066f3->isMethod('GET')) { \App\ShopTheme::freshList(); return Response::success(array('themes' => \App\ShopTheme::get(), 'default' => \App\ShopTheme::defaultTheme()->name)); } $spa8b8a9 = \App\ShopTheme::whereName($spf066f3->post('shop_theme'))->firstOrFail(); \App\System::_set('shop_theme_default', $spa8b8a9->name); $spa8b8a9->config = @json_decode($spf066f3->post('theme_config')) ?? array(); $spa8b8a9->saveOrFail(); return Response::success(); } function order(Request $spf066f3) { $spfb8cbe = array('order_clean_unpay_open', 'order_clean_unpay_day'); if ($spf066f3->isMethod('GET')) { $sp9d4382 = array(); foreach ($spfb8cbe as $sp34e4b5) { $sp9d4382[$sp34e4b5] = (int) \App\System::_get($sp34e4b5); } return Response::success($sp9d4382); } $this->setInt($spf066f3, $spfb8cbe); return Response::success(); } function vcode(Request $spf066f3) { $spe8d0d0 = array('vcode_driver', 'vcode_geetest_id', 'vcode_geetest_key'); $spbf0f91 = array('vcode_login', 'vcode_shop_buy', 'vcode_shop_search'); if ($spf066f3->isMethod('GET')) { $sp9d4382 = array(); foreach ($spe8d0d0 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = \App\System::_get($sp34e4b5); } foreach ($spbf0f91 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = (int) \App\System::_get($sp34e4b5); } return Response::success($sp9d4382); } $this->set($spf066f3, $spe8d0d0); $this->setInt($spf066f3, $spbf0f91); return Response::success(); } function email(Request $spf066f3) { $spe8d0d0 = array('mail_driver', 'mail_smtp_host', 'mail_smtp_port', 'mail_smtp_username', 'mail_smtp_password', 'mail_smtp_from_address', 'mail_smtp_from_name', 'mail_smtp_encryption', 'sendcloud_user', 'sendcloud_key'); $spbf0f91 = array('mail_send_order'); if ($spf066f3->isMethod('GET')) { $sp9d4382 = array(); foreach ($spe8d0d0 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = \App\System::_get($sp34e4b5); } foreach ($spbf0f91 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = (int) \App\System::_get($sp34e4b5); } return Response::success($sp9d4382); } $this->set($spf066f3, $spe8d0d0); $this->setInt($spf066f3, $spbf0f91); return Response::success(); } function sms(Request $spf066f3) { $spe8d0d0 = array('sms_api_id', 'sms_api_key'); $spbf0f91 = array('sms_send_order', 'sms_price'); if ($spf066f3->isMethod('GET')) { $sp9d4382 = array(); foreach ($spe8d0d0 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = \App\System::_get($sp34e4b5); } foreach ($spbf0f91 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = (int) \App\System::_get($sp34e4b5); } return Response::success($sp9d4382); } $this->set($spf066f3, $spe8d0d0); $this->setInt($spf066f3, $spbf0f91); return Response::success(); } function storage(Request $spf066f3) { $spe8d0d0 = array('storage_driver', 'storage_s3_access_key', 'storage_s3_secret_key', 'storage_s3_region', 'storage_s3_bucket', 'storage_oss_access_key', 'storage_oss_secret_key', 'storage_oss_bucket', 'storage_oss_endpoint', 'storage_oss_cdn_domain', 'storage_qiniu_domains_default', 'storage_qiniu_domains_https', 'storage_qiniu_access_key', 'storage_qiniu_secret_key', 'storage_qiniu_bucket', 'storage_qiniu_notify_url'); $spbf0f91 = array('storage_oss_is_ssl', 'storage_oss_is_cname'); if ($spf066f3->isMethod('GET')) { $sp9d4382 = array(); foreach ($spe8d0d0 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = \App\System::_get($sp34e4b5); } foreach ($spbf0f91 as $sp34e4b5) { $sp9d4382[$sp34e4b5] = (int) \App\System::_get($sp34e4b5); } return Response::success($sp9d4382); } $this->set($spf066f3, $spe8d0d0); $this->set($spf066f3, $spbf0f91); return Response::success(); } function emailTest(Request $spf066f3) { $this->validate($spf066f3, array('to' => 'required')); $sp6c6383 = $spf066f3->post('to'); try { $sp9b52fe = Mail::to($sp6c6383)->send(new \App\Mail\Test()); return Response::success($sp9b52fe); } catch (\Throwable $sp3f4aab) { \App\Library\LogHelper::setLogFile('mail'); \Log::error('Mail Test Exception:' . $sp3f4aab->getMessage()); return Response::fail($sp3f4aab->getMessage(), $sp3f4aab); } } function orderClean(Request $spf066f3) { $this->validate($spf066f3, array('day' => 'required|integer|min:1')); $sp403e35 = (int) $spf066f3->post('day'); \App\Order::where('status', \App\Order::STATUS_UNPAY)->where('created_at', '<', (new \Carbon\Carbon())->addDays(-$sp403e35))->delete(); return Response::success(); } }