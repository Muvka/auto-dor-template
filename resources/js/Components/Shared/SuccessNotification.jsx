import React, { useId } from 'react';
import clsx from 'clsx';

const SuccessNotification = ({ className = ''}) => {
	const titleId = useId();

	return (
		<section className={clsx('success-notification', className)} aria-labelledby={titleId}>
			<h2 id={titleId} className='visually-hidden'>Заявка успешно отправлена</h2>
			<p className='title title--small title--center success-notification__subtitle'>Спасибо!</p>
			<p className='success-notification__description'>В ближайшее время мы приступим к рассмотрению замечания</p>
			<a href={route('client.shared.home')} className='button button--accent success-notification__link'>Вернуться на главную</a>
		</section>
	);
};

export default SuccessNotification;
