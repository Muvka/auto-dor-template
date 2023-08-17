import React from 'react';
import clsx from 'clsx';

import Logotype from './Logotype';
import UserWidget from '../User/UserWidget';

const PageHeader = ({ className = '' }) => {
	return (
		<header className={clsx('page-header', className)}>
			<div className='page-header__content-container container'>
				<Logotype />
				<UserWidget />
			</div>
		</header>
	);
};

export default PageHeader;
