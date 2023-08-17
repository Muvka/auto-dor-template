import React from 'react';
import clsx from 'clsx';

const LinksWidget = ({ title = 'Заголовок', description = '', links = [], className = '' }) => {
	if (!links.length) {
		return null;
	}

	return (
		<div className={clsx('links-widget', className)}>
			<div className='links-widget__text'>
				<p className='links-widget__title'>{title}</p>
				{Boolean(description) && <p className='links-widget__description'>{description}</p>}
			</div>
			{links.length === 1 ? (
				<a href={links[0].url} target={links[0].target ?? '_self'} className={clsx('icon-button', {
					'icon-button--danger': links[0].danger,
				})} aria-label={links[0].label}>
					<svg width='18' height='18' className='icon-button__icon' aria-hidden='true'>
						<use xlinkHref={`#${links[0].icon}`} />
					</svg>
				</a>
			) : (
				<ul className='links-widget__list'>
					{links.map((link) => (
						<li key={link.id} className='links-widget__item'>
							<a href={link.url} target={link.target ?? '_self'} className={clsx('icon-button', {
								'icon-button--danger': link.danger,
							})} aria-label={link.label}>
								<svg width='18' height='18' className='icon-button__icon' aria-hidden='true'>
									<use xlinkHref={`#${link.icon}`} />
								</svg>
							</a>
						</li>
					))}
				</ul>
			)}
		</div>
	);
};

export default LinksWidget;
