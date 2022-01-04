<?php require __DIR__. '\parts\__connect_db.php';
$title = "新增合作餐廳列表";
$pageName = "restaurant_add";
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
                <h5 class="card-header py-3">新增</h5>
                <div class="card-body">
                    <form onsubmit="sendData();return false;" name="form1">
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
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_intro" class="form-label">餐廳介紹</label>
                            <textarea type="text" class="form-control" name="res_intro" id="res_intro" cols="10" rows="5" placeholder="請輸入餐廳介紹"></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_address" class="form-label">餐廳地址</label>
                            <textarea type="text" class="form-control" name="res_address" id="res_address" cols="10" rows="2" placeholder="請輸入餐廳地址"></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="res_ser_hours" class="mb-2">營業時間</label>
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_sun"
                                name="ser_sun"
                                placeholder="輸入星期日營業時間"
                            />
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_mon"
                                name="ser_mon"
                                placeholder="輸入星期一營業時間"
                            />
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_tue"
                                name="ser_tue"
                                placeholder="輸入星期二營業時間"
                            />
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_wed"
                                name="ser_wed"
                                placeholder="輸入星期三營業時間"
                            />
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_thu"
                                name="ser_thu"
                                placeholder="輸入星期四營業時間"
                            />
                            <input
                                type="text"
                                class="form-control mb-3"
                                id="ser_fri"
                                name="ser_fri"
                                placeholder="輸入星期五營業時間"
                            />
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
                                placeholder="請輸入餐廳官網網址"
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
                                placeholder="請輸入餐廳FB網址"
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
                                placeholder="請輸入餐廳IG網址"
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
                            placeholder="請輸入餐廳訂位網址"
                            />
                            <div class="form-text"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary w-25">新增</button>
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
    
    const res_name = document.querySelector("#res_name");
    const res_intro = document.querySelector("#res_intro");

    
    const res_t_number = document.querySelector("#res_t_number");
    
    const tele_re = /\d{2,4}-?\d{3,4}-?\d{3,4}#?(\d+)?/g;
    
    function sendData(){

        res_name.nextElementSibling.innerHTML = '';
        res_intro.nextElementSibling.innerHTML = '';

        res_t_number.nextElementSibling.innerHTML = '';

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





        if (isPass === true) {
            const fd = new FormData(document.form1);
            fetch('restaurant_add-api.php',{
            method: 'POST',
            body: fd,
            })
            .then( res => res.json())
            .then( data => {
            console.log(data);
            })
        }
            
        
}
</script>
<?php include __DIR__ . '\parts\__foot.html'?>