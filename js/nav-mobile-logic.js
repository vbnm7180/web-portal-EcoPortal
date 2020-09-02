var count = 0;

//Функция для скрытия кнопки сайдбара при изменении размера экрана
window.onresize = function() {
    if (window.innerWidth > 1024) {

        document.getElementById('nav-mobile').style.display = "none";
        document.getElementById('nav-button').style.display = "none";
        //w = 0;
        //w1 = 0;
        //console.log("document.body.innerWidth=", window.innerWidth);
    }

    if (window.innerWidth < 1024) {
        document.getElementById('nav-button').style.display = "block";
        //w = 0;
        //w1 = 0;
        //console.log("document.body.innerWidth=", window.innerWidth);
    }
}

//Обработчики событий окрытия/закрытия сайдбара
document.getElementById('nav-button').addEventListener("click", show_nav);
document.addEventListener("click", hide_nav); //срабатывает при любом нажатии, в т.ч. и на кнопке сайдбара

//Функции окрытия сайдбара
function show_nav() {
    document.getElementById('nav-mobile').style.display = "flex";
    document.getElementById('nav-button').style.display = "none";
    count = 1; //если сайдбар открыт count = 1
}

//Функции закрытия сайдбара
function hide_nav() {
    if (count == 2) //проверка только когда сайдбар уже был открыт
    {
        w = getComputedStyle(document.getElementById('nav-mobile')).width; //получение строки из css свойства
        w1 = w.match(/\d+/)[0]; //с помощью регулярного выражения выбирается число, стоящее до точки
        //console.log('w1=', w1);
        //console.log('pagex=', event.pageX);
        //event.pageX>w
        var x = event.pageX;
        if (x > w1) //если нажатие в области экрана большей, чем ширина сайдбара - закрыть его
        {
            document.getElementById('nav-mobile').style.display = "none";
            document.getElementById('nav-button').style.display = "block";
            count = 0; //обнуление счетчика и переменных
            w = 0;
            w1 = 0;
        }
        if (x < w1) { count = 2; }
        //count=0;
    }
    if (count == 1) count = count + 1; //если сайдбар был открыт count=2
    //console.log('count=', count);
}