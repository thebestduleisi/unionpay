<?php
namespace unionpay\unionpc;
use Flight;
include_once ROOT_PATH.'/vendor/unionpay/sdk/acp_service.php';
/**
 * 交易说明：	前台类交易成功才会发送后台通知。后台类交易（有后台通知的接口）交易结束之后成功失败都会发通知。
 *              为保证安全，涉及资金类的交易，收到通知后请再发起查询接口确认交易成功。不涉及资金的交易可以以通知接口respCode=00判断成功。
 *              未收到通知时，查询接口调用时间点请参照此FAQ：https://open.unionpay.com/ajweb/help/faq/list?id=77&level=0&from=0
 */
class notify{
	public function checksign($data){
		$a = '';
		foreach ( $data as $key => $val ) {
			$k = isset($mpi_arr[$key]) ?$mpi_arr[$key] : $key ;
			$a .= $k.'=>'.$val.'&';
		}
		Flight::log($a);
		if(isset($data ['signature'])){
			$ret = \com\unionpay\acp\sdk\AcpService::validate ( $data ) ? true : false;
		} else {
			$ret = false;
		}
		Flight::log($ret.'hhhhhhhhhh');
		return $ret;
	}
}

?>
