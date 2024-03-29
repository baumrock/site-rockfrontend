import { attr } from './attr';
import { addClass, hasClass, removeClass, removeClasses } from './class';
import { once, trigger } from './event';
import { startsWith, toNodes } from './lang';
import { css, propName } from './style';

const clsTransition = 'uk-transition';
const transitionEnd = 'transitionend';
const transitionCanceled = 'transitioncanceled';

function transition(element, props, duration = 400, timing = 'linear') {
    duration = Math.round(duration);
    return Promise.all(
        toNodes(element).map(
            (element) =>
                new Promise((resolve, reject) => {
                    for (const name in props) {
                        const value = css(element, name);
                        if (value === '') {
                            css(element, name, value);
                        }
                    }

                    const timer = setTimeout(() => trigger(element, transitionEnd), duration);

                    once(
                        element,
                        [transitionEnd, transitionCanceled],
                        ({ type }) => {
                            clearTimeout(timer);
                            removeClass(element, clsTransition);
                            css(element, {
                                transitionProperty: '',
                                transitionDuration: '',
                                transitionTimingFunction: '',
                            });
                            type === transitionCanceled ? reject() : resolve(element);
                        },
                        { self: true },
                    );

                    addClass(element, clsTransition);
                    css(element, {
                        transitionProperty: Object.keys(props).map(propName).join(','),
                        transitionDuration: `${duration}ms`,
                        transitionTimingFunction: timing,
                        ...props,
                    });
                }),
        ),
    );
}

export const Transition = {
    start: transition,

    async stop(element) {
        trigger(element, transitionEnd);
        await Promise.resolve();
    },

    async cancel(element) {
        trigger(element, transitionCanceled);
        await Promise.resolve();
    },

    inProgress(element) {
        return hasClass(element, clsTransition);
    },
};

const animationPrefix = 'uk-animation-';
const animationEnd = 'animationend';
const animationCanceled = 'animationcanceled';

function animate(element, animation, duration = 200, origin, out) {
    return Promise.all(
        toNodes(element).map(
            (element) =>
                new Promise((resolve, reject) => {
                    trigger(element, animationCanceled);
                    const timer = setTimeout(() => trigger(element, animationEnd), duration);

                    once(
                        element,
                        [animationEnd, animationCanceled],
                        ({ type }) => {
                            clearTimeout(timer);

                            type === animationCanceled ? reject() : resolve(element);

                            css(element, 'animationDuration', '');
                            removeClasses(element, `${animationPrefix}\\S*`);
                        },
                        { self: true },
                    );

                    css(element, 'animationDuration', `${duration}ms`);
                    addClass(element, animation, animationPrefix + (out ? 'leave' : 'enter'));

                    if (startsWith(animation, animationPrefix)) {
                        origin && addClass(element, `uk-transform-origin-${origin}`);
                        out && addClass(element, `${animationPrefix}reverse`);
                    }
                }),
        ),
    );
}

const inProgressRe = new RegExp(`${animationPrefix}(enter|leave)`);

export const Animation = {
    in: animate,

    out(element, animation, duration, origin) {
        return animate(element, animation, duration, origin, true);
    },

    inProgress(element) {
        return inProgressRe.test(attr(element, 'class'));
    },

    cancel(element) {
        trigger(element, animationCanceled);
    },
};
