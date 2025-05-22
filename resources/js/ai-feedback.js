function showTooltip(tooltipEl, event) {
    tooltipEl.style.display = "block";
    tooltipEl.style.left = `${event.pageX + 10}px`;
    tooltipEl.style.top = `${event.pageY + 10}px`;
}

function hideTooltips(...tooltips) {
    tooltips.forEach((t) => (t.style.display = "none"));
}

function setupAutoTooltip() {
    document.addEventListener("click", function (e) {
        const tooltip = document.getElementById("tooltip");
        const tooltipHighlight = document.getElementById("tooltip-highlight");
        const tooltipRed = document.getElementById("tooltip-red");

        if (
            e.target.matches(".span-desc, .span-desc-highlight, .span-desc-red")
        ) {
            e.stopPropagation();
            hideTooltips(tooltip, tooltipHighlight, tooltipRed);

            const tooltipText = e.target.dataset.tooltip || "";
            let targetTooltip = tooltip;

            if (e.target.classList.contains("span-desc-highlight")) {
                targetTooltip = tooltipHighlight;
            } else if (e.target.classList.contains("span-desc-red")) {
                targetTooltip = tooltipRed;
            }

            targetTooltip.textContent = tooltipText;
            showTooltip(targetTooltip, e);
        }
    });
}

function setupGlobalTooltipClose(tooltipMap) {
    document.addEventListener("click", function (e) {
        for (const [triggers, tooltip] of tooltipMap) {
            const triggerList = Array.isArray(triggers)
                ? triggers
                : Array.from(triggers);
            const clickedInsideTrigger = triggerList.some((trigger) =>
                trigger.contains(e.target)
            );
            if (!tooltip.contains(e.target) && !clickedInsideTrigger) {
                tooltip.style.display = "none";
            }
        }
    });
}

function resetAnimation(el, className) {
    el.classList.remove(className);
    void el.offsetWidth;
    el.classList.add(className);
}

function animateOnLoad() {
    const pie = document.querySelector(".pie-chart");
    if (pie) resetAnimation(pie, "animate-rotate-in");

    const bars = document.querySelectorAll(".bar-chart");
    bars.forEach((bar) => resetAnimation(bar, "animate-grow"));
}

function animateScore() {
    const scoreEl = document.getElementById("score-display");
    const targetScore = parseInt(scoreEl.dataset.score) || 0;
    let current = 0;
    const increment = Math.ceil(targetScore / 60);
    const interval = setInterval(() => {
        current += increment;
        if (current >= targetScore) {
            current = targetScore;
            clearInterval(interval);
        }
        scoreEl.textContent = `${current}%`;
    }, 20);
}

window.addEventListener("load", () => {
    const tooltip = document.getElementById("tooltip");
    const tooltipHighlight = document.getElementById("tooltip-highlight");
    const tooltipRed = document.getElementById("tooltip-red");

    const spanDescs = document.querySelectorAll(".span-desc");
    const spanDescHighlights = document.querySelectorAll(
        ".span-desc-highlight"
    );
    const spanDescReds = document.querySelectorAll(".span-desc-red");

    setupAutoTooltip();

    setupGlobalTooltipClose([
        [spanDescs, tooltip],
        [spanDescHighlights, tooltipHighlight],
        [spanDescReds, tooltipRed],
    ]);

    animateOnLoad();
    animateScore();
});
