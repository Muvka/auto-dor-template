import React from 'react';
import { Link, useForm, usePage } from '@inertiajs/react';
import clsx from 'clsx';

import TextInput from '../Shared/TextInput';
import logotypeImage from '../../../images/shared/logotype.svg';

const LoginForm = ({ className = '' }) => {
	const { shared } = usePage().props;
	const { data, setData, post, processing, errors, clearErrors } = useForm({
		email: '',
		password: '',
	});

	function login(event) {
		event.preventDefault();
		post(route('client.user.auth.login'));
	}

	return (
		<div className={clsx('login-form', className)}>
			<div className='login-form__site-info'>
				<img src={logotypeImage} alt='' width='120' height='120' className='login-form__logotype' />
				{Boolean(shared?.app?.name) && <p className='login-form__name'>{shared.app.name}</p>}
				{Boolean(shared?.app?.slogan) && <p className='login-form__slogan'>{shared.app.slogan}</p>}
			</div>
			<form className='form login-form__form' onSubmit={login}>
				<TextInput type='email' label='Введите E-mail' hiddenLabel placeholder='E-mail' value={data.email}
						   error={errors.email}
						   onChange={(event) => {
							   clearErrors('email');
							   setData('email', event.target.value);
						   }} />
				<TextInput type='password' label='Введите пароль' hiddenLabel placeholder='Пароль' value={data.password}
						   onChange={(event) => {
							   clearErrors('email');
							   setData('password', event.target.value);
						   }} />
				<button type='submit' disabled={processing} className='button button--accent'>Войти</button>
			</form>
			<Link href={route('client.shared.home')} className='link link--secondary link--center'>Вернуться на главную</Link>
		</div>
	);
};

export default LoginForm;
