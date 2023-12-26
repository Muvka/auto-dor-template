import React, { useId, useState } from 'react';
import clsx from 'clsx';
import { Link } from '@inertiajs/react';

import chevronRightId from '../../../images/shared/icons/icon-chevron-right.svg';

const MunicipalAreaList = ({ areas = [], routeName = '', className = '' }) => {
	const titleId = useId();
	const [activeView, setActiveView] = useState('map');
	const toggleButtonText = activeView === 'map' ? 'Выбрать район из списка' : 'Выбрать район на карте';

	if (!areas.length) {
		return null;
	}

	return (
		<section className={clsx('municipal-area-list', className)} aria-labelledby={titleId}>
			<h2 id={titleId} className='visually-hidden'>Список муниципальных районов</h2>
			<p className='municipal-area-list__description'>
				Выберите район из списка или на карте
			</p>
			<button type='button' className='button button--accent municipal-area-list__toggle-button' onClick={() => {
				setActiveView(activeView === 'map' ? 'list' : 'map');
			}}>
				{toggleButtonText}
			</button>
			<ul className={clsx('municipal-area-list__list', {
				'municipal-area-list__list--hidden': activeView === 'map',
			})}>
				{areas.map((area) => (
					<li key={area.id} className='municipal-area-list__item'>
						<Link href={routeName ? route(routeName, area.id) : '/'}
							  className='municipal-area-list__link'>
							{area.name}
							<svg width='16' height='16' className='municipal-area-list__icon' aria-hidden='true'>
								<use xlinkHref={`#${chevronRightId}`} />
							</svg>
						</Link>
					</li>
				))}
			</ul>
			<img src='/assets/client/images/municipal-area/map.jpeg' width='900' height="496" alt=''
				 className={clsx('municipal-area-list__map', {
					 'municipal-area-list__map--hidden': activeView === 'list',
				 })} />
			{/*<svg viewBox='0 0 479 599' width='479' height='599' className={clsx('municipal-area-list__map', {*/}
			{/*	'municipal-area-list__map--hidden': activeView === 'list',*/}
			{/*})}>*/}
			{/*	{areas.map((area) => (*/}
			{/*		Boolean(area.svgPath) ? (*/}
			{/*			<Link key={area.id}*/}
			{/*				  href={routeName ? route(routeName, area.id) : '/'}*/}
			{/*				  aria-label={area.name}>*/}
			{/*				<path d={area.svgPath} fill={area.pathColor} className='municipal-area-list__path' />*/}
			{/*			</Link>*/}
			{/*		) : null*/}
			{/*	))}*/}
			{/*</svg>*/}
		</section>
	);
};

export default MunicipalAreaList;
