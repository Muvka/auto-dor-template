import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import clsx from 'clsx';

import logotypeImage from '../../../images/shared/logotype.svg';

const Logotype = ({ className = '' }) => {
	const { url, props = {} } = usePage();

	return (
		<div className={clsx('logotype', className)}>
			<img src={logotypeImage} alt='' width='76' height='76' className='logotype__image' />
			<p className='logotype__title'>
				<Link href={route('client.shared.home')} className={clsx('logotype__link', {
					'logotype__link--inactive': url === '/',
				})}>{props.shared?.app?.name}</Link>
			</p>
			<p className='logotype__tagline'>{props.shared?.app?.slogan}</p>
		</div>
	);
};

export default Logotype;
