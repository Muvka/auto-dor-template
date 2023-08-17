import React, { useId } from 'react';
import clsx from 'clsx';

const ServiceList = ({ services = [], className = '' }) => {
	const titleId = useId();

	if (!services) {
		return null;
	}

	return (
		<section className={clsx('service-list', className)} aria-labelledby={titleId}>
			<h2 id={titleId} className='visually-hidden'>Cписок услуг</h2>
			<ul className='service-list__list'>
				{services.map((service) => (
					<li key={service.id}
						className={clsx('service-list__item', `service-list__item--${service.id}`)}>
						{service.text}
					</li>
				))}
			</ul>
		</section>
	);
};

export default ServiceList;
