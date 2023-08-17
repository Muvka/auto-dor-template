import React from 'react';
import { Head } from '@inertiajs/react';

import BlankLayout from '../../Layouts/BlankLayout';
import LoginForm from '../../Components/User/LoginForm';

const LoginPage = ({ title = '' }) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='visually-hidden'>{title}</h1>
			<LoginForm className='container container--extra-narrow' />
		</>
	);
};

LoginPage.layout = (page) => <BlankLayout children={page} />;

export default LoginPage;
