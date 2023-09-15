<template>
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <breadcrumbs :pageTitle="pageTitle"></breadcrumbs>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Faq Area Wrapper ==-->
        <section class="faq-area">
            <div class="container">
                <div class="row flex-xl-row-reverse">
                    <div class="col-lg-6 col-xl-7">
                        <div class="faq-thumb">
                            <img src="/images/about/livesta_brand.jpg" width="601" height="368" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-5">
                        <div class="faq-content">
                            <div class="faq-text-img"><img src="/images/photos/faq.webp" width="199" height="169" alt="Image"></div>
                            <h2 class="faq-title">Часті запитання</h2>
                            <div class="faq-line"></div>
                            <p class="faq-desc">Відповіді на найчастіші запитання</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="margin-top: 20px">
                        <div class="accordion" id="FaqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                        Чи можна сплатити карткою будь-якого банку?
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        <p>При оформленні замовлення Ви маєте можливість здійснити оплату за допомогою платіжної картки Visa або MasterСard безпосередньо на сайті. Компанія Лівеста Косметикс гарантує безпеку та захист інтернет-платежів. Всі операції з платіжними картами проводяться відповідно до вимог платіжних систем VISA International та MasterCard.<br>
                                            Надана Вами персональна інформація (ім'я, телефон, номер платіжної картки) є конфіденційною і не підлягає розголошенню. Дані Вашої картки передаються тільки в зашифрованому вигляді і не зберігаються на нашому Web-сервері.<br>
                                            Перед оплатою перевірте, будь ласка:<br>
                                            - чи відкрита можливість оплати покупок Вашою платіжною картою в Інтернеті;<br>
                                            - чи достатньо коштів на платіжній картці для оплати зробленого Вами замовлення;<br>
                                            - чи не закінчився термін дії платіжної картки.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        Чи можна сплатити під час отримання замовлення?
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        <p>Оплата при отриманні можлива при оформленні доставки накладеним платежем.<br>
                                            1. Вартість послуги "накладений платіж" для транспортної компанії «Нова пошта» становить 20 грн + 2% від суми замовлення.<br>
                                            2. Вартість послуги "накладений платіж" для транспортної компанії «УкрПошта» становить 1% від суми замовлення, але не менше ніж 10 грн.<br>
                                            3. Оформлення доставки накладеним платежем можливо зі статусу Лідер та вище.<br>
                                            4. Функція доступна лише в перші три тижні дії каталогу. Четвертий тиждень оформлення замовлень лише по передоплаті.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        Чи можна сплатити через Приват 24?
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        <p>Для оплати замовлення вам треба знати свій особистий номер Консультанта (вказано в Особистому Кабінеті) та суму до сплати.<br>
                                            1. Увійдіть до свого аккаунта на сайті або в додатку Privat24;<br>
                                            2. Зайдіть у вкладку "Усі послуги";<br>
                                            3. Прокрутіть сторінку нижче та оберіть опцію "Послуги";<br>
                                            4. У списку можливих послуг, що відкрився, оберіть опцію "Оплата косметичної продукції»;<br>
                                            5. Далі виберіть «Лівеста" (вже значиться в списку запропонованих варіантів), введіть реєстраційний номер Консультанта. Якщо усі дані введені правильно, а ПІБ відповідає Консультанту, замовлення якого Ви маєте намір сплатити, вкажіть суму до сплати. Після цього додайте платіж у "Кошик».</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        Доставка новою поштою?
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        <p>При замовленні на суму 300 грн і більше доставка в ПОШТОМАТИ здійснюється за рахунок Компанії. Акція діє до 30 червня 2023р (включно)<br>

                                            Накладений платіж:<br>
                                            1. Вартість послуги "накладений платіж" становить 20 грн + 2% від суми замовлення.<br>
                                            2. Оформлення доставки накладеним платежем можливо зі статусу Лідер та вище.<br>
                                            3. Зверніть увагу! Функція доступна лише в перші три тижні дії каталогу. Четвертий тиждень оформлення замовлень лише по передоплаті.<br>
                                            4. Доставка в поштомат доступна лише по передоплаті. Максимальний розмір відправлення 40х60х30 см, вага до 20 кг, оголошена вартість до 6000 грн.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        Доставка УкрПошта?
                                    </button>
                                </h2>
                                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        <p>Від 0,01 до 799,99 грн – доставку сплачує отримувач<br>
                                            Від 800 грн до сплати – доставка за рахунок Компанії<br>
                                            <br>
                                            Накладений платіж:<br>
                                            1. Вартість послуги "накладений платіж" становить 10 грн + 1% від суми замовлення<br>
                                            2. Оформлення доставки накладеним платежем можливо зі статусу Лідер та вище.<br>
                                            3. Зверніть увагу! Функція доступна лише в перші три тижні дії каталогу. Четвертий тиждень оформлення замовлень лише по передоплаті.<br>
                                            <br>
                                            Доставка доступна тільки в тих населених пунктах, де нема активних бойових дій або тимчасової окупації.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading6">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                        Самовивіз?
                                    </button>
                                </h2>
                                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        <p>Ви можете безкоштовно отримати замовлення в пункті збору замовлень Livesta за адресою просп. Миру, 2А, Миколаїв, Миколаївська область, 54000<br>
                                            <br>
                                            Замовлення можна забрати по будням (з понеділка по п’ятницю) з 9.00 до 18.00.<br>
                                            Самовивіз доступний лише по передоплаті</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Faq Area Wrapper ==-->

    </main>
</template>

<script>
    import breadcrumbs from '../elements/breadcrumb/_breadcrumbs.vue';
    export default {
        name: "faq",
        data(){
            return{
                pageTitle: 'Питання'
            }
        },
        // meta info
        metaInfo:{
            title: 'Допомога'
        },
        components:{
            breadcrumbs
        },
        mounted() {
            $(document).trigger('change');
        },
    }
</script>

<style scoped>

</style>
