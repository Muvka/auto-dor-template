import React, { useId } from 'react';
import { usePage } from '@inertiajs/react';
import clsx from 'clsx';

const ApplicationsWidget = ({ className = '' }) => {
	const applications = usePage().props.shared?.applications;
	const titleId = useId();

	if (!applications || !applications.length) {
		return null;
	}

	return (
		<div className={clsx('applications-widget', className)} aria-labelledby={titleId}>
			<h2 id={titleId} className='applications-widget__title'>Скачать приложение:</h2>
			<ul className='applications-widget__list'>
				{applications.map((application) => (
					<li key={application.id} className='applications-widget__item'>
						<a href={application.url} target='_blank' rel='nofollow noopener noreferrer'
						   className='applications-widget__link'>
							<img src={application.image} alt={application.label} width='123' height='37'
								 className='applications-widget__image' />
						</a>
					</li>
				))}
			</ul>
		</div>
	);
};

export default ApplicationsWidget;
