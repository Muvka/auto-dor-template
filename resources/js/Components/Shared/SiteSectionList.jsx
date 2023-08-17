import React, { useId } from 'react';
import { Link } from '@inertiajs/react';
import clsx from 'clsx';

const SiteSectionList = ({ sections = [], className = '' }) => {
	const titleId = useId();

	return (
		<section className={clsx('site-section-list', className)} aria-labelledby={titleId}>
			<h2 id={titleId} className='visually-hidden'>Cписок разделов сайта</h2>
			<ul className='site-section-list__list'>
				{sections.map((section) => (
					<li key={section.id} className={`site-section-list__item site-section-list__item--${section.id}`}>
						<h3 className='site-section-list__title'>
							<Link href={section.url} className='site-section-list__link' dangerouslySetInnerHTML={{__html: section.title}} />
						</h3>
					</li>
				))}
			</ul>
			<div className='site-section-list__footer'>

			</div>
		</section>
	);
};

export default SiteSectionList;
