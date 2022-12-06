<?php
/**
 * css.php
 * @author liuchg
 */
?>
<style>
    :root {
        --white: white;
        --gradient: linear-gradient(-45deg, #FFA600 0%, #FF5E03 50%);
        --big: linear-gradient(45deg, red, yellow);
        --form: #eeefef;
        --border-radius: 4px;
        --form-width: 500px;
        --form-mob-width: 320px;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        font: 20px/1.5 sans-serif;
        background: var(--white);
    }

    h1 {
        font-size: 2rem;
        text-align: center;
        margin-top: 20vh;
    }

    button,
    label {
        cursor: pointer;
    }

    label {
        display: block;
    }

    button,
    input,
    textarea {
        font-family: inherit;
        font-size: 100%;
        border: none;
    }

    textarea {
        resize: none;
    }
</style>
<style>
    /*CUSTOM VARIABLES HERE*/
    .feedback-label,
    .form {
        position: fixed;
        top: 50%;
        right: 0;
    }

    .feedback-label {
        transform-origin: top right;
        transform: rotate(-90deg) translate(50%, -100%);
        z-index: 2;
    }

    .form {
        width: var(--form-width);
        max-height: 90vh;
        transform: translate(100%, -50%);
        padding: 30px;
        overflow: auto;
        background: var(--form);
        z-index: 1;
    }
</style>
<style>
    /*CUSTOM VARIABLES HERE*/

    .feedback-label,
    .form input,
    .form textarea,
    .form button {
        border-radius: var(--border-radius);
    }

    .feedback-label,
    .form button {
        background: var(--big);
        color: var(--white);
    }

    .feedback-label:hover,
    .form button:hover {
        filter: hue-rotate(-45deg);
    }

    .feedback-label {
        padding: 5px 10px;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    form div:not(:last-child) {
        margin-bottom: 20px;
    }

    form div:last-child {
        text-align: right;
    }

    .form input,
    .form textarea {
        padding: 0 5px;
        width: 100%;
    }

    .form button {
        padding: 10px 20px;
        width: 50%;
        max-width: 120px;
    }

    .form input {
        height: 40px;
    }

    .form textarea {
        height: 220px;
    }
</style>
<style>
    /*CUSTOM VARIABLES HERE*/
    .feedback-label,
    .form {
        position: fixed;
        top: 50%;
        right: 0;
    }

    .feedback-label {
        transform-origin: top right;
        transform: rotate(-90deg) translate(50%, -100%);
        z-index: 2;
    }

    .form {
        width: var(--form-width);
        max-height: 90vh;
        transform: translate(100%, -50%);
        padding: 30px;
        overflow: auto;
        background: var(--form);
        z-index: 1;
    }
</style>
<style>
    [type="checkbox"]:checked + .feedback-label {
        transform: rotate(-90deg) translate(50%, calc((var(--form-width) + 100%) * -1));
    }

    [type="checkbox"]:focus + .feedback-label {
        outline: 2px solid rgb(77, 144, 254);
    }

    [type="checkbox"]:checked ~ .form {
        transform: translate(0, -50%);
    }

    .feedback-label,
    .form {
        transition: all 0.35s ease-in-out;
    }
</style>
<input type="checkbox" id="mycheckbox">
<label for="mycheckbox" class="feedback-label">FEEDBACK</label>
<form class="form">
    <div>
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email">
    </div>
    <div>
        <label for="comment">Comment</label>
        <textarea id="comment"></textarea>
    </div>
    <div>
        <button type="submit">Send</button>
    </div>
</form>
