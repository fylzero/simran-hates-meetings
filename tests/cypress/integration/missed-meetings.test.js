describe('Missed Meetings', () => {
    beforeEach(() => {
        cy.refreshDatabase();
    });

    it('authenticated users can see the dashboard', () => {
        cy.seed();

        cy.login({ email: 'user@example.com' });
        cy.visit('/').contains('Click here to log (yet another) meeting');
    });

    it('increments and decrements incident counts when button is clicked', () => {
        cy.seed();

        cy.login({ email: 'user@example.com' });
        cy.visit('/');

        // Grab original display values and stash to LS (variables don't work in Cypress!)
        cy.get('[data-cy="total-incidents"]').then((element) => {
            localStorage.setItem('ogTotalIncidents', element.text().trim());
        });
        cy.get('[data-cy="todays-incidents"]').then((element) => {
            localStorage.setItem('ogTodaysIncidents', element.text().trim());
        });
        cy.get('[data-cy="this-weeks-incidents"]').then((element) => {
            localStorage.setItem('ogThisWeeksIncidents', element.text().trim());
        });
        cy.get('[data-cy="this-months-incidents"]').then((element) => {
            localStorage.setItem('ogThisMonthsIncidents', element.text().trim());
        });

        // CLICK THE BUTTON!
        cy.get('[data-cy=log-missed-meeting]').click();
        cy.wait(500);

        // Check new displayed values against the OG vales in LS
        cy.get('[data-cy="days-since-incident"]').should((daysSinceIncident) => {
            expect(parseInt(daysSinceIncident.text().trim())).equal(0);
        });
        cy.get('[data-cy="total-incidents"]').should((totalIncidents) => {
            expect(parseInt(totalIncidents.text().trim())).equal(
                parseInt(localStorage.getItem('ogTotalIncidents')) + 1,
            );
        });
        cy.get('[data-cy="todays-incidents"]').should((todaysIncidents) => {
            expect(parseInt(todaysIncidents.text().trim())).equal(
                parseInt(localStorage.getItem('ogTodaysIncidents')) + 1,
            );
        });
        cy.get('[data-cy="this-weeks-incidents"]').should((thisWeeksIncidents) => {
            expect(parseInt(thisWeeksIncidents.text().trim())).equal(
                parseInt(localStorage.getItem('ogThisWeeksIncidents')) + 1,
            );
        });
        cy.get('[data-cy="this-months-incidents"]').should((thisMonthsIncidents) => {
            expect(parseInt(thisMonthsIncidents.text().trim())).equal(
                parseInt(localStorage.getItem('ogThisMonthsIncidents')) + 1,
            );
        });
    });

    it('adds a new record to the shame log', () => {
        cy.seed('UserSeeder');

        cy.login({ email: 'user@example.com' });
        cy.visit('/');
        cy.get('[data-cy=log-missed-meeting]').click();
        cy.visit('/shame-log').contains('1 second ago');
    });
});
