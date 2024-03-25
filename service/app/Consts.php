<?php

namespace App;

class Consts
{
    /**
     * Favicon`s of online-gkh for sending notification. Used in ExpoAPI-model.
     */
    public const FAVICON_OGKH = "https://xn--80amifbldd4e.xn--p1ai/icon.png";

    /**
     * Servers of API_KEY in firebase-server. Used in FirebaseAPI-model.
     * Generated on the server side of firebase.
     */
    public const SERVER_KEY = "AAAAJS6tDsM:APA91bH6coD43hJV3yLio5UKoPwz7NJbzFQV3YhYjsZ971m9498E71ld4UGAJJ2IVJCcn8SMs3Yqc4zRYrJJl8Da39u9aPTj2Fc8CgCs0f_c93lYpDEBa1v-cO81BuJ62OrEY9G-ZDkl";

    /**
     * Тип уведомления. Уведомление отправляется в мобильное устройство пользователя.
     */
    public const TYPE_PUSH_MOBILE = "push-mobile";

    /**
     * Тип уведомления. Уведомление отправляется в браузер, на компьютер пользователя.
     */
    public const TYPE_PUSH_WEB = "push-web";

    /**
     * Тип уведомления - Email.
     */
    public const TYPE_EMAIL = "email";

    /**
     * Причина рассылки уведомления - новое начисление по ЛС.
     */

    public const ACCRUALS_REASON = "accruals";

    /**
     * Причина рассылки уведомления - новые лицевые счета по адресу.
     */
    public const ACCOUNTS_REASON = "accounts";

    /**
     * Причина рассылки уведомления - новости.
     */
    public const NEWS_REASON = "news";


    /**
     *
     */
    public const SUCCESS_TYPE = "success";

    /**
     *
     */
    public const ERROR_TYPE = "error";

    /**
     *
     */
    public const EXCEPTION_TYPE = "exception";


    /**
     * Код ошибки. Используется, если возникает НЕ предопределённая ошибка на сервернной части ИЛИ ошибка в запросе.
     */
    public const ERROR_CODE = 500;

    /**
     * Код исключения.
     */
    public const EXCEPTION_CODE = 501;

    /**
     * Код исключения. Неверно составлен запрос.
     */
    public const ERROR_CLIENT_CODE = 400;

    /**
     * Код предпреждения/исключения. Когда запрос выполнился, но выполнился с ошибками.
     */
    public const WARNING_CODE = 203;

    /**
     * Код успешно обработанного ответа.
     */
    public const SUCCESS_CODE = 200;


    /**
     * Статусы уведомлений отправлено/не отправлено.
     */
    public const STATUS_SUCCESS = 1;
    public const STATUS_ERROR = 6;
}
