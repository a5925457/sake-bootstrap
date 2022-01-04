<?php require __DIR__. '\parts\__connect_db.php';
$title = "修改合作餐廳";
$pageName = "restaurant_edit";

if(! isset($_GET['res_id'])) {
    header('Location: restaurant.php');
    exit;
};

$sid = intval($_GET['res_id']);
$row = $pdo->query("SELECT * FROM `restaurant` WHERE res_id=$sid")->fetch();

if(empty($row)) {
    header('Location: restaurant.php');
    exit;
}

?>
<?php include __DIR__ . '\parts\__head.php'?>
<?php include __DIR__ . '\parts\__navbar.html'?>
<?php include __DIR__ . '\parts\__sidebar.html'?>

<?php include __DIR__ . '\parts\__main_start.html'?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->

<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <h5 class="card-header py-3">修改</h5>
                <div class="card-body">
                    <form onsubmit="sendData();return false;" name="form1">
                    <input type="hidden" name="res_id" value="<?= $row['res_id'] ?>">
                        <div class="form-group mb-3">
                            <label for="res_type" class="mb-2">餐廳類型</label>
                            <select class="form-select" aria-label="Default select example" name="res_type" id="res_type">
                                <option value="Fine Dining">Fine Dining</option>
                                <option value="Sake Bar">Sake Bar</option>
                                <option value="居酒屋">居酒屋</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_area" class="mb-2">餐廳地區</label>
                            <select class="form-select" aria-label="Default select example" name="res_area" id="res_area">
                                <option value="北部">北部</option>
                                <option value="中部">中部</option>
                                <option value="南部">南部</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_name" class="mb-2">餐廳名稱</label>
                            <input
                                type="text"
                                class="form-control"
                                id="res_name"
                                name="res_name"
                                placeholder="請輸入餐廳名稱"
                                value="<?= htmlentities($row['res_name']) ?>"
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_intro" class="form-label">餐廳介紹</label>
                            <textarea type="text" class="form-control" name="res_intro" id="res_intro" cols="10" rows="5" placeholder="請輸入餐廳介紹"><?= htmlentities($row['res_intro']) ?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_address" class="form-label">餐廳地址</label>
                            <textarea type="text" class="form-control" name="res_address" id="res_address" cols="10" rows="2" placeholder="請輸入餐廳地址"><?= htmlentities($row['res_address']) ?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_ser_hours" class="mb-2">營業時間　（例如：12:00–15:00 18:00–22:00 或休息）</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_sun"
                                name="ser_sun"
                                placeholder="輸入星期日營業時間"
                            />
                            <div class="form-text"></div>
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_mon"
                                name="ser_mon"
                                placeholder="輸入星期一營業時間"
                            />
                            <div class="form-text"></div>
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_tue"
                                name="ser_tue"
                                placeholder="輸入星期二營業時間"
                            />
                            <div class="form-text"></div>
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_wed"
                                name="ser_wed"
                                placeholder="輸入星期三營業時間"
                            />
                            <div class="form-text"></div>
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_thu"
                                name="ser_thu"
                                placeholder="輸入星期四營業時間"
                            />
                            <div class="form-text"></div>
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_fri"
                                name="ser_fri"
                                placeholder="輸入星期五營業時間"
                            />
                            <div class="form-text"></div>
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_sat"
                                name="ser_sat"
                                placeholder="輸入星期六營業時間"
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_t_number" class="mb-2">餐廳電話</label>
                            <input
                                type="text"
                                class="form-control"
                                id="res_t_number"
                                name="res_t_number"
                                placeholder="請輸入餐廳電話"
                                value="<?= htmlentities($row['res_t_number']) ?>"
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="web_link" class="mb-2">餐廳官網</label>
                            <input
                                type="text"
                                class="form-control"
                                id="web_link"
                                name="web_link"
                                placeholder="請輸入餐廳官網網址，若無可略過"
                                value="<?= htmlentities($row['web_link']) ?>"
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fb_link" class="mb-2">餐廳FB</label>
                            <input
                                type="text"
                                class="form-control"
                                id="fb_link"
                                name="fb_link"
                                placeholder="請輸入餐廳FB網址，若無可略過"
                                value="<?= htmlentities($row['fb_link']) ?>"
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="ig_link" class="mb-2">餐廳IG</label>
                            <input
                                type="text"
                                class="form-control"
                                id="ig_link"
                                name="ig_link"
                                placeholder="請輸入餐廳IG網址，若無可略過"
                                value="<?= htmlentities($row['ig_link']) ?>"
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="booking_link" class="mb-2">訂位網址</label>
                            <input
                            type="text"
                            class="form-control"
                            id="booking_link"
                            name="booking_link"
                            placeholder="請輸入餐廳訂位網址，若無可略過"
                            value="<?= htmlentities($row['booking_link']) ?>"
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary w-25">修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 如果要 modal 的話留下面的結構 -->
<?php include __DIR__ . '\parts\__modal.html'?>

<?php include __DIR__ . '\parts\__script.html'?>
<!-- 如果要 modal 的話留下面的 script -->
<script>
    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));
    
    const res_type = document.querySelector("#res_type");
    const res_area = document.querySelector("#res_area");
    const res_name = document.querySelector("#res_name");
    const res_intro = document.querySelector("#res_intro");
    const res_address = document.querySelector("#res_address");

    const ser_sun = document.querySelector("#ser_sun");
    const ser_mon = document.querySelector("#ser_mon");
    const ser_tue = document.querySelector("#ser_tue");
    const ser_wed = document.querySelector("#ser_wed");
    const ser_thu = document.querySelector("#ser_thu");
    const ser_fri = document.querySelector("#ser_fri");
    const ser_sat = document.querySelector("#ser_sat");
    
    const res_t_number = document.querySelector("#res_t_number");
    const web_link = document.querySelector("#web_link");
    const fb_link = document.querySelector("#fb_link");
    const ig_link = document.querySelector("#ig_link");
    const booking_link = document.querySelector("#booking_link");
    
    const tele_re = /\d{2,4}-?\d{3,4}-?\d{3,4}#?(\d+)?/;
    const url_re = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/i;
    
    function sendData(){

        res_name.nextElementSibling.innerHTML = '';
        res_intro.nextElementSibling.innerHTML = '';
        res_address.nextElementSibling.innerHTML = '';
        ser_sun.nextElementSibling.innerHTML = '';
        ser_mon.nextElementSibling.innerHTML = '';
        ser_tue.nextElementSibling.innerHTML = '';
        ser_wed.nextElementSibling.innerHTML = '';
        ser_thu.nextElementSibling.innerHTML = '';
        ser_fri.nextElementSibling.innerHTML = '';
        ser_sat.nextElementSibling.innerHTML = '';
        res_t_number.nextElementSibling.innerHTML = '';
        web_link.nextElementSibling.innerHTML = '';
        fb_link.nextElementSibling.innerHTML = '';
        ig_link.nextElementSibling.innerHTML = '';
        booking_link.nextElementSibling.innerHTML = '';

        // 檢查資料是否輸入正確
        let isPass = true;
        // 檢查餐廳名稱
        if (res_name.value === "") {
            isPass = false;
            res_name.nextElementSibling.innerHTML = `
            <div class="alert alert-dark mt-2" role="alert">請輸入餐廳名稱</div>
            `;
        }
        if (res_name.value.length > 50) {
            isPass = false;
            res_name.nextElementSibling.innerHTML = `
            <div class="alert alert-dark mt-2" role="alert">餐廳名稱請小於50個字元</div>
            `;
        }
        // 檢查餐廳介紹
        if (res_intro.value === "") {
            isPass = false;
            res_intro.nextElementSibling.innerHTML = `
            <div class="alert alert-dark mt-2" role="alert">請輸入餐廳介紹</div>
            `;
        }
        if (res_intro.value.length > 255) {
            isPass = false;
            res_intro.nextElementSibling.innerHTML = `
            <div class="alert alert-dark mt-2" role="alert">餐廳介紹請小於255個字元</div>
            `;
        }
        // 檢查餐廳地址
        if (res_address.value === "") {
            isPass = false;
            res_address.nextElementSibling.innerHTML = `
            <div class="alert alert-dark mt-2" role="alert">請輸入餐廳地址</div>
            `;
        }
        if (res_address.value.length > 255) {
            isPass = false;
            res_address.nextElementSibling.innerHTML = `
            <div class="alert alert-dark mt-2" role="alert">餐廳地址請小於255個字元</div>
            `;
        }
        // 檢查是否輸入營業時間
        if (ser_sun.value === "") {
            isPass = false;
            ser_sun.nextElementSibling.innerHTML = `
            <div class="alert alert-dark" role="alert">請輸入星期日營業時間</div>
            `;
        }
        if (ser_mon.value === "") {
            isPass = false;
            ser_mon.nextElementSibling.innerHTML = `
            <div class="alert alert-dark" role="alert">請輸入星期一營業時間</div>
            `;
        }
        if (ser_tue.value === "") {
            isPass = false;
            ser_tue.nextElementSibling.innerHTML = `
            <div class="alert alert-dark" role="alert">請輸入星期二營業時間</div>
            `;
        }
        if (ser_wed.value === "") {
            isPass = false;
            ser_wed.nextElementSibling.innerHTML = `
            <div class="alert alert-dark" role="alert">請輸入星期三營業時間</div>
            `;
        }
        if (ser_thu.value === "") {
            isPass = false;
            ser_thu.nextElementSibling.innerHTML = `
            <div class="alert alert-dark" role="alert">請輸入星期四營業時間</div>
            `;
        }
        if (ser_fri.value === "") {
            isPass = false;
            ser_fri.nextElementSibling.innerHTML = `
            <div class="alert alert-dark" role="alert">請輸入星期五營業時間</div>
            `;
        }
        if (ser_sat.value === "") {
            isPass = false;
            ser_sat.nextElementSibling.innerHTML = `
            <div class="alert alert-dark" role="alert">請輸入星期六營業時間</div>
            `;
        }
        // 檢查餐廳電話
        if (res_t_number.value == "") {
            isPass = false;
            res_t_number.nextElementSibling.innerHTML = `<div class="alert alert-dark mt-2" role="alert">
             請輸入餐廳電話
            </div>`;
        }
        if (res_t_number.value && !tele_re.test(res_t_number.value)) {
            isPass = false;
            res_t_number.nextElementSibling.innerHTML = `<div class="alert alert-dark mt-2" role="alert">
             請輸入正確電話號碼
            </div>`;
        }
        // 檢查網址是否正確
        if (web_link.value && !url_re.test(web_link.value)) {
            isPass = false;
            web_link.nextElementSibling.innerHTML = `<div class="alert alert-dark mt-2" role="alert">
             請輸入正確網址
            </div>`;
        }
        if (fb_link.value && !url_re.test(fb_link.value)) {
            isPass = false;
            fb_link.nextElementSibling.innerHTML = `<div class="alert alert-dark mt-2" role="alert">
             請輸入正確網址
            </div>`;
        }
        if (ig_link.value && !url_re.test(ig_link.value)) {
            isPass = false;
            ig_link.nextElementSibling.innerHTML = `<div class="alert alert-dark mt-2" role="alert">
             請輸入正確網址
            </div>`;
        }
        if (booking_link.value && !url_re.test(booking_link.value)) {
            isPass = false;
            booking_link.nextElementSibling.innerHTML = `<div class="alert alert-dark mt-2" role="alert">
             請輸入正確網址
            </div>`;
        }


        if (isPass === true) {
            const fd = new FormData(document.form1);
            fetch('restaurant_edit-api.php',{
            method: 'POST',
            body: fd,
            })
            .then( res => res.json())
            .then( data => {
            console.log(data);
                if(data.success) {
			    	document.querySelector('.modal-body').innerHTML = "資料修改成功";
                    document.querySelector('.modal-footer').innerHTML = `<a href="restaurant.php" class="btn btn-secondary">完成</a>`;
                    modal.show();
                } else {
                    document.querySelector('.modal-body').innerHTML = data.error || "資料修改發生錯誤";
                    modal.show();
                }
            })
        }
            
        
}

    const data = <?= json_encode($row) ?>;  // 將資料庫資料送到前端
    res_type.value = data.res_type;
    res_area.value = data.res_area;
    let time = JSON.parse(data.res_ser_hours);
    ser_sat.value = time[0];
    ser_sun.value = time[1];
    ser_mon.value = time[2];
    ser_tue.value = time[3];
    ser_wed.value = time[4];
    ser_thu.value = time[5];
    ser_fri.value = time[6];

</script>
<?php include __DIR__ . '\parts\__foot.html'?>