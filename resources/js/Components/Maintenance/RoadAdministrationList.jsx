import React from 'react';
import clsx from 'clsx';
import { Link } from '@inertiajs/react';

const RoadAdministrationList = ({ administrations = [], className = '' }) => {
	if (!administrations.length) {
		return null;
	}

	return (
		<div className={clsx('road-administration-list', className)}>
			<ul className='road-administration-list__list'>
				{administrations.map((administration) => (
					<li key={administration.id} className='road-administration-list__item'>
						<Link
							href={route('client.maintenance.road_administrations.show', administration.id)}
							className='road-administration-list__link'>{administration.name}</Link>
					</li>
				))}
			</ul>
		</div>
	);
};

export default RoadAdministrationList;
