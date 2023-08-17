import React from 'react';
import { Link } from '@inertiajs/react';
import clsx from 'clsx';

const ClosedSectionList = ({ sections = [], className = '' }) => {
	if (!sections.length) {
		return null;
	}

	return (
		<div className={clsx('closed-section-list', className)}>
			<ul className='closed-section-list__list'>
				{sections.map((section) => (
					<li key={section.id} className={`closed-section-list__item closed-section-list__item--${section.id}`}>
						<Link href={section.url} className='closed-section-list__link'>{section.title}</Link>
					</li>
				))}
			</ul>
		</div>
	);
};

export default ClosedSectionList;
