import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import clsx from 'clsx';

import loginIconId from '../../../images/shared/icons/icon-login.svg';
import logoutIconId from '../../../images/shared/icons/icon-logout.svg';

const UserWidget = ({ className = '' }) => {
	const { shared = {} } = usePage().props;
	const isLogged = Boolean(shared.user);

	return (
		<div className={clsx('user-widget', className)}>
			{isLogged && (
				<p className='user-widget__name'>
					<Link href={route('client.maintenance.closed_section')} className='user-widget__link'>
						{shared.user.name}
					</Link>
				</p>
			)}
			{isLogged ? (
				<Link href={route('client.user.auth.logout')} method='delete' as='button' type='button'
					  className='user-widget__button'>
					<svg width='24' height='24' className='user-widget__logout-icon' aria-hidden='true'>
						<use xlinkHref={`#${logoutIconId}`} />
					</svg>
					Выйти
				</Link>
			) : (
				<Link href={route('client.user.auth.login')} className='user-widget__button'>
					<svg width='24' height='24' className='user-widget__logout-icon' aria-hidden='true'>
						<use xlinkHref={`#${loginIconId}`} />
					</svg>
					Войти
				</Link>
			)}
		</div>
	);
};

export default UserWidget;
