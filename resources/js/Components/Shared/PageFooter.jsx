import React from 'react';
import clsx from 'clsx';

import ApplicationsWidget from '../Information/ApplicationsWidget';

const PageFooter = ({ className = '' }) => {
	return (
		<footer className={clsx('page-footer', className)}>
			<div className='page-footer__content-container container'>
				<ApplicationsWidget />
			</div>
		</footer>
	);
};

export default PageFooter;
