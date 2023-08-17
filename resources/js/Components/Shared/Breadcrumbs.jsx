import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import clsx from 'clsx';

const Breadcrumbs = ({ className = '' }) => {
	const { breadcrumbs } = usePage().props;

	if (!breadcrumbs || !breadcrumbs.length) {
		return null;
	}

	return (
		<nav className={clsx('breadcrumbs', className)} aria-label='Хлебные крошки'>
			<ol className='breadcrumbs__list'>
				{breadcrumbs.map(crumb => (
					<li key={crumb.url} className={clsx('breadcrumbs__item', {
						'visually-hidden': crumb.is_current_page,
					})}>
						{crumb.is_current_page ? (
							<Link href={crumb.url} className='breadcrumbs__link breadcrumbs__link--current'
								  aria-current>{crumb.title}</Link>
						) : (
							<Link href={crumb.url} className='breadcrumbs__link'>{crumb.title}</Link>
						)}
					</li>
				))}
			</ol>
		</nav>
	);
};

export default Breadcrumbs;
