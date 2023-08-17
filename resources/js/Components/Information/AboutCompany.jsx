import React from 'react';
import clsx from 'clsx';

import TextContent from '../Shared/TextContent';
import ServiceList from './ServiceList';
import { usePage } from '@inertiajs/react';

const AboutCompany = ({ className = '' }) => {
	const { description, services } = usePage().props;

	return (
		<div className={clsx('about-company', className)}>
			{Boolean(description) && (
				<TextContent className='about-company__description'>{description}</TextContent>
			)}
			{Boolean(services.length) && <ServiceList services={services} className='about-company__services' />}
		</div>
	);
};

export default AboutCompany;
