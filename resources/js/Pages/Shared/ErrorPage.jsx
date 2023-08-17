import React from 'react';
import { Head, Link } from '@inertiajs/react';

import BlankLayout from '../../Layouts/BlankLayout';

const ErrorPage = ({ status = 404, title = 'Ошибка', description = '' }) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<div className={`error-notification error-notification--${status} container`}>
				<h1 className='title title--small title--center error-notification__title'>{title}</h1>
				{Boolean(description) && (
					<p className='error-notification__description'>{description}</p>
				)}
				<Link href={route('client.shared.home')}
					  className='button button--accent error-notification__link'>Вернуться на главную</Link>
			</div>
		</>
	);
};

ErrorPage.layout = (page) => <BlankLayout children={page} />;

export default ErrorPage;
